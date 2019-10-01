TARGET := babys_first_bof
CFLAGS := -m32 -fno-stack-protector -U_FORTIFY_SOURCE -fno-stack-protector -z execstack -mpreferred-stack-boundary=2 -w

all:
	gcc $(CFLAGS) $(TARGET).c -o $(TARGET)

clean:
	rm -f $(TARGET)
