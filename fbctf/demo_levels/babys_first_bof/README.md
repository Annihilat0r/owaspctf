Setup
------------

```
make
```

This will create the binary `babys_first_bof`. Note that you might have to run `sudo apt-get install gcc-multilib` first in order to build a 32 bit binary.

1. Go to platform admin panel (index.php?p=admin).
2. Go to "Levels: Flags".
3. Click on "Add Flag Level".
4. Complete details like name (Baby's First BOF), points, and hints you want to give to contestants.
5. Click "Create" button.
6. Now we'll add the binary as an attachment to the level. Click on "Edit" on the level you created.
7. Click "+ Attachment".
8. Choose the binary file created by the Makefile.
9. Finally, click "Create" and "Save".

Enable the level by clicking on the "On" button on the top left corner. You can now go to the Gameboard to see your level. People will only be able to submit answers once the
game is on.

Now that the problem has been uploaded to the platform, you need to host it somewhere that players can connect to. You'll need to create a server separate from the server the scoreboard is running, upload the `babys_first_bof` binary and `flag.txt` to the same folder, and then run the command, `socat TCP4-LISTEN:4000,fork,reuseaddr exec:./babys_first_bof`. Now teams can connect to the binary on port 4000, exploit and steal the flag, and submit the flag to the scoreboard.

Description
------------

You will receive a binary to check for vulnerabilities. Can you crack it?

Flag
------------

`flag{yay!_your_first_bof}`
