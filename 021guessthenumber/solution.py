#!/usr/bin/env python3

import socket

soc = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
soc.connect(("21.owaspctf.gq", 8000))

tries = 0

res = soc.recv(4096).decode()
print(res)
l, r = 0, 2 ** 32 - 1

while l <= r and "OWASP" not in res:
    guess = l + (r - l) // 2
    clients_input = f"{guess}".encode()
    print(f"> {clients_input}")

    soc.send(clients_input) # we must encode the string to bytes
    tries += 1
    result_bytes = soc.recv(4096) # the number means how the response can be in bytes
    res = result_bytes.decode("utf8") # the return will be in bytes, so decode
    print(f"< {res}")

    if "big" in res:
        r = guess - 1
    elif "small" in res:
        l = guess + 1
