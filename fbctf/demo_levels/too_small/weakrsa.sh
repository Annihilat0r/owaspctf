#!/bin/bash

openssl genrsa -out private_key.pem 256
openssl rsa -in private_key.pem -out public_key.pem -outform PEM -pubout
openssl rsautl -encrypt -inkey public_key.pem -pubin -in tooSmallflag.txt -out tooSmallflag.enc
openssl rsautl -encrypt -inkey public_key.pem -pubin -in tooSmallflag2.txt -out tooSmallflag2.enc
openssl rsautl -encrypt -inkey public_key.pem -pubin -in tooSmallflag3.txt -out tooSmallflag3.enc
tar -cvf tooSmall.tar.gz public_key.pem *.enc
rm -f *.enc *.pem
