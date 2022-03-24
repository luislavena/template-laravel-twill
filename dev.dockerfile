FROM ghcr.io/luislavena/hydrofoil-php:8.0

# ---
# Install extra development tools
#
# TODO: Support arch other than x86_64
RUN --mount=type=cache,target=/var/cache/apt \
    --mount=type=cache,target=/var/lib/apt \
    --mount=type=tmpfs,target=/var/log \
    set -eux; \
    cd /tmp; \
    # ---
    # Pyroscope
    { \
        export \
            PYROSCOPE_VERSION=0.13.0 \
            PYROSCOPE_SHA256=26e0d704960d0b9b9ec61e979520fb888ec9269c5ce609abbbd9bc28cf81c664; \
        curl --fail -Lo pyroscope.tar.gz https://github.com/pyroscope-io/pyroscope/releases/download/v${PYROSCOPE_VERSION}/pyroscope-${PYROSCOPE_VERSION}-linux-amd64.tar.gz; \
        echo "${PYROSCOPE_SHA256} *pyroscope.tar.gz" | sha256sum -c - >/dev/null 2>&1; \
        tar -xf pyroscope.tar.gz; \
        mv pyroscope /usr/local/bin/; \
        rm -rf pyroscope.tar.gz; \
    }; \
    # smoke tests
    [ "$(command -v pyroscope)" = '/usr/local/bin/pyroscope' ]; \
    pyroscope --version
