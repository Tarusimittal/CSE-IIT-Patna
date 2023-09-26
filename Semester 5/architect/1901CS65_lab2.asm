############################################
#                                          # 
# Program to print odd prime Number till n #
#                                          #
############################################

.data

msg1: 		 .asciiz "Enter The number: "
newline:	 .asciiz "\n"

.text
.globl main

main:

    # Initialize running pointer
    li $t1, 1

    # Input message 1
    li $v0, 4
    la $a0, msg1
    syscall

    # Input n
    li $v0, 5
    syscall
    move $t2, $v0
    
# Loop for Printing primes
loop1:       
        # Move the current number pointer to $a0
        move $a0, $t1

	#Jump to isPrime to find if current number is prime or not
        jal Whether_Prime

        #if $v0 is 1, the number is prime, hence print else skip this nummber
        move $t4, $v0
        beq $t4, $zero, loop_again

        li $v0, 1
        move $a0, $t1
        syscall

        li $v0, 4
        la $a0, newline
        syscall

loop_again:
        # increment current pointer number by 2 since only odd prime needs to be checked
        addi $t1, $t1, 2

        #loop till pointer < n
        bgt $t1, $t2, exit
        j loop1

exit:
    li $v0, 10  
    syscall 


# a0 is the current number
# v0 == 1 if prime else v0 == 0

Whether_Prime:
    li $t0, 2				# Pointer to check if current number is divisible bya ny previous number

    # loop
    beq $a0, 1, Not_a_Prime   		# if current number == 1, then it is definitely not prime

    loop2:
        rem $t3, $a0, $t0   		# find remainder when current number is divided by any previous number
        beq $t3, $zero, Not_a_Prime	# if remainder == 0 then current number is not prime
        addi $t0, $t0, 1		# else increment the pointer
        beq $t0, $a0, Is_Prime		# if pointer == current number, this number is a prime number
        j loop2

    Not_a_Prime:
        li $v0, 0			# set v0 = 0 to tell that this is not a prime
        jr $ra

    Is_Prime:
        li $v0, 1			# set v0 =1 to tell that this is a prime
        jr $ra