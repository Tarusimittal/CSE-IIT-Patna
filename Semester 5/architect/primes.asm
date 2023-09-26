# Program to print odd prime Number till n


.data

msg1: 		 .asciiz "Enter The number: "
newline:	 .asciiz "\n"

.text
.globl main

main:

    # Initialize running pointer ti as 1
    li $t1, 1

    # Input message 1
    li $v0, 4      #4 is for printing,v0 stores
    la $a0, msg1  #load the address
    syscall       # message is printed

    # Input n
    li $v0, 5   # 5 inputs integer
    syscall
    move $t2, $v0  #moved to t2

# Loop for Printing primes
loop1:
        move $a0, $t1   # Move the current number pointer to $a0


        jal Whether_Prime  #Jump to isPrime to find if current number is prime or not

        #if $v0 is 1, the number is prime, hence print else skip this number
        move $t4, $v0
        beq $t4, 1, loop_again #branch if equal

        li $v0, 1
        move $a0, $t1
        syscall

        li $v0, 4
        la $a0, newline
        syscall

loop_again:
        # increment current pointer number by 2 since only odd prime needs to be checked
        addi $t1, $t1, 1

        #loop till pointer < n
        bgt $t1, $t2, exit
        j loop1

exit:
    li $v0, 10
    syscall


# the current number is a0
# v0 == 1 if prime else v0 == 0

Whether_Prime:
    li $t0, 2				# Pointer to check if current number is divisible by any previous number

    # loop
    beq $a0, 1, Not_a_Prime   		# if current number == 1, then it is definitely not prime

    loop2:
        rem $t3, $a0, $t0   		    # find remainder and storing in t3 when current number is divided by any previous number
        beq $t3, $zero, Not_a_Prime	# if remainder == 0 then current number is not prime
        addi $t0, $t0, 1		        # else increment the pointer
        beq $t0, $a0, Is_Prime	   	# if pointer == current number, this number is a prime number
        j loop2

    Not_a_Prime:
        li $v0, 0			# we will be setting v0 = 0 to tell that this is not a prime
        jr $ra        #back to after jump

    Is_Prime:
        li $v0, 1			# we will be setting v0 =1 to tell that this is a prime
        jr $ra
