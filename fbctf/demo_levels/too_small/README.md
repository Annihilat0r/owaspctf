Setup
------------

```
./weakrsa.sh
```

This will generate a 256 bit RSA key and encrypt the flag files.

1. Go to platform admin panel (index.php?p=admin).
2. Go to "Levels: Flags".
3. Click on "Add Flag Level".
4. Complete details like name (Too Small), points and hints you want to give to contestants. Below is an example description.
5. Click "Create" button.
6. Now we'll add the binary as an attachment to the level. Click on "Edit" on the level you created.
7. Click "+ Attachment".
8. Choose the tar.gz file created by the script.
9. Finally, click "Create" and "Save".

Enable the level by clicking on the "On" button on the top left corner. You can now go to the Game board to see your level. People will only be able to submit answers once the
game is on.

Description
------------

You've recovered 3 encrypted files and an RSA public key. Since the files are RSA encrypted and RSA hasn't been broken yet, I guess you should just give up now.

Flag
------------

`flag{RSA_i5_n00b}`
