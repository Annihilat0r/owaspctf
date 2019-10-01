#include <stdlib.h>
#include <stdio.h>

int main(int argc, char *argv[]) {
	int a = 1;
    char buffer[256];
    printf("buffer address: %p\n", buffer);
    char* command = "cat flag.txt";
    printf("Enter input: ");
    fflush(stdout);
    gets(buffer);
    system("echo '7h15 b1n4ry 15 unpwn4bl3!!1!'");
}
