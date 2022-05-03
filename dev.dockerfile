FROM ghcr.io/luislavena/hydrofoil-php:8.0

# ---
# Install extra extensions and tools
#
# TODO: Support arch other than x86_64
RUN --mount=type=cache,target=/var/cache/apt \
    --mount=type=cache,target=/var/lib/apt \
    --mount=type=tmpfs,target=/var/log \
    set -eux; \
    cd /tmp; \
    # ---
    # Use `docker-php-ext-install` to ease installation of PHP
    # extensions
    #
    # Ref: https://github.com/mlocati/docker-php-extension-installer
    export \
      PHP_EXT_INSTALLER_VERSION=1.5.11 \
      PHP_EXT_INSTALLER_SHA256SUM=bc80e8fb6da789e937095330a3568b5dbfdbb61061133bf5bcaa1e1b58b55992 \
    ; \
    cd /tmp; \
    { \
      curl --fail -Lo install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/download/${PHP_EXT_INSTALLER_VERSION}/install-php-extensions; \
      echo "${PHP_EXT_INSTALLER_SHA256SUM} *install-php-extensions" | sha256sum -c - >/dev/null 2>&1; \
      chmod +x install-php-extensions; \
    }; \
    # ---
    # Install additional PHP extensions
    #
    # (extra to the ones included in the base)
    ./install-php-extensions \
      sockets \
    ; \
    # remove PHP extension installer
    rm -f ./install-php-extensions; \
    # RoadRunner
    { \
        export \
            ROADRUNNER_VERSION=2.9.2 \
            ROADRUNNER_SHA256=d4656881c5ed4120a7b4bc5958c7ee602427b3009b5fe1b517d5556021bf79fa; \
        curl --fail -Lo roadrunner.tar.gz https://github.com/roadrunner-server/roadrunner/releases/download/v${ROADRUNNER_VERSION}/roadrunner-${ROADRUNNER_VERSION}-linux-amd64.tar.gz; \
        echo "${ROADRUNNER_SHA256} *roadrunner.tar.gz" | sha256sum -c - >/dev/null 2>&1; \
        tar -xf roadrunner.tar.gz; \
        mv roadrunner-${ROADRUNNER_VERSION}-linux-amd64/rr /usr/local/bin/; \
        rm -rf roadrunner.tar.gz roadrunner-${ROADRUNNER_VERSION}-*; \
    }; \
    # smoke tests
    [ "$(command -v rr)" = '/usr/local/bin/rr' ]; \
    rr --version
