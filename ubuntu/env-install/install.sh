# Script for environment install upon default Ubuntu 10.04
# installed.

# Develope tools
aptitue install build-essential

# Install GCC 4.7
add-apt-repository ppa:ubuntu-toolchain-r/test
aptitude install gcc-4.7 g++-4.7

# Firestarter
aptitude install firestarter

# System tools
aptitude install tree
