#!/bin/bash
#
# fbctf formatting script
#
# Usage: format.sh [-h|--help] [ARGUMENT]
#
# Parameters:
#   -h, --help            Shows this help message and exit.
#
# Optional Parameters:
#   PATH                  Path to fbctf code.

SRC_LOCATION="/vagrant/src"
IGNORE_FILES=("language/language.php")

function usage() {
  printf "\nfbctf formatting script\n"
  printf "\nUsage: %s [-h|--help] [ARGUMENT] \n" "${0}"
  printf "\nParameters:\n"
  printf "  -h, --help \t\tShows this help message and exit.\n"
  printf "\nOptional Arguments:\n"
  printf "  PATH \tPath to fbctf code.\n"
}

if [[ "$1" == "-h" || "$1" == "--help" ]]
then
  usage
  exit 0
elif [[ -n "$1" ]]
then
  SRC_LOCATION="$1"
fi


for file in "${IGNORE_FILES[@]}"; do
  fullpath="$SRC_LOCATION/$file"
  mv "$fullpath" "$fullpath.back"
done

hh_format "$SRC_LOCATION"

for file in "${IGNORE_FILES[@]}"; do
  fullpath="$SRC_LOCATION/$file"
  mv "$fullpath.back" "$fullpath"
done
