#!/bin/sh

. "$(dirname -- "$0")/../tools/helpers.sh"

main()
{
    if [ "$1" = "" ]; then
        fatalError "Expected command parameter not provided"
    fi

    init "$@"

    if [ "$SERVICE" = "all" ] || [ "$SERVICE" = "lint" ]; then
        phpStan
        blast
    fi

    if [ "$SERVICE" = "all" ] || [ "$SERVICE" = "conflict-markers" ]; then
        checkLeftConflictMarkers
    fi

    if [ "$SERVICE" = "all" ] || [ "$SERVICE" = "prettify" ] || [ "$SERVICE" = "format" ]; then
        phpCsFixer
        prettier
    fi

    if [ "$SERVICE" = "all" ] || [ "$SERVICE" = "php-cs-fixer" ]; then
        phpCsFixer
    fi

    if [ "$SERVICE" = "all" ] || [ "$SERVICE" = "phpstan" ]; then
        phpStan
    fi

    if [ "$SERVICE" = "blast" ]; then
        blast
    fi

    checkStatus "$@"
}

init()
{
    SERVICE=$1

    LOGS_PATH="$(dirname -- "$0")/../tools/logs"

    TEMP_PATH="$(dirname -- "$0")/../tools/tmp"

    loadColors

    if [ -z ${PHPCSFIXER+x} ]; then
        PHPCSFIXER="vendor/bin/php-cs-fixer"
    fi

    if [ -z ${PRETTIER+x} ]; then
        PRETTIER="node_modules/prettier/bin-prettier.js"
    fi

    if [ -z ${PHPSTAN+x} ]; then
        PHPSTAN="vendor/bin/phpstan "
    fi

    if [ -z ${BLAST+x} ]; then
        BLAST="php artisan blast:publish"
    fi
}

phpCsFixer()
{
    message "Running PHP-CS-Fixer..."

    checkExecutable "PHP CS Fixer" $PHPCSFIXER

    if [ "$FILES" = "." ]; then
        if ! $PHPCSFIXER fix -q --no-interaction --allow-risky=yes; then
            fatalError "PHP CS Fixer finished with errors"
        fi
    else
        for FILE in $FILES; do
            if ! $PHPCSFIXER fix "$FILE" -q --no-interaction --allow-risky=yes; then
                fatalError "PHP CS Fixer finished with errors"
            fi
        done
    fi

    WAS_EXECUTED="$PHPCSFIXER"
}

prettier()
{
    message "Running Prettier..."

    checkExecutable "Prettier" $PRETTIER

    if [ "$FILES" = "." ]; then
        if ! $PRETTIER --loglevel=error --quiet --write .; then
            fatalError "Prettier finished with errors"
        fi
    else
        for FILE in $FILES; do
            if ! $PRETTIER --loglevel=error --quiet --write "$FILE"; then
                fatalError "Prettier finished with errors"
            fi
        done
    fi

    WAS_EXECUTED="$PHPCSFIXER"
}

phpStan()
{
    message "Running PHPStan..."

    checkExecutable "PHPStan" $PHPSTAN

    LOGFILE="$LOGS_PATH/phpstan.log"
    PATHS_FILE="$TEMP_PATH/phpstan.files.txt"

    if [ "$FILES" = "." ]; then
        if ! $PHPSTAN analyse >> $LOGFILE; then
            fatalError "PHPStan finished with errors"
        fi
    else
        \rm "$PATHS_FILE"

        if ! $PHPSTAN analyse $FILES >$LOGFILE 2>&1; then
            fatalError "PHPStan finished with errors"
        fi
    fi

    WAS_EXECUTED="$PHPCSFIXER"
}

blast()
{
    message "Running Blast..."

    if ! php artisan | grep blast:publish; then
        errorMessage "WARNING: Blast is not installed, skipping."
    else
        if ! $BLAST; then
            fatalError "Blast finished with errors"
        fi
    fi

    WAS_EXECUTED="$BLAST"
}

checkExecutable()
{
    if [ ! -f "$2" ]; then
        echo
        echo "The executable for $1 ($1) wa not found."
        echo

        exit 1
    fi
}

checkStatus()
{
    if [ -z ${WAS_EXECUTED+x} ]; then
        fatalError "No commands were found for '$1'"
    fi
}

checkLeftConflictMarkers()
{
    CONFLICT_MARKERS='<<<<<<<|=======|>>>>>>>'

    if [ "$FILES" = "." ]; then
        CHECK=$(git diff --staged | grep "^+" | grep -v CONFLICT_MARKERS | grep -Ei "$CONFLICT_MARKERS" -c)

        if [ "$CHECK" -gt 0 ]; then
            fatalError "${YELLOW}Conflict markers found on staged files${NC}"
        fi
    else
        for FILE in $FILES; do
            # shellcheck disable=SC2002
            CHECK=$(cat "$FILE" | grep -v CONFLICT_MARKERS | grep -Ei "$CONFLICT_MARKERS" -c)

            if [ "$CHECK" -gt 0 ]; then
                fatalError "${YELLOW}Conflict markers found on staged file: $FILE${NC}"
            fi
        done
    fi

    WAS_EXECUTED="conflict-markers-checker"
}

buildArguments()
{
    FILES=""

    COMMANDS=""

    for ARG in "$@"; do
        if [ -f "$ARG" ]; then
            FILES="$FILES $ARG"
        else
            COMMANDS="${COMMANDS} $ARG"
        fi
    done

    if [ "$FILES" = "" ]; then
        FILES='.'
    fi
}

buildArguments "$@"

for COMMAND in $COMMANDS; do
    main "$COMMAND"
done
