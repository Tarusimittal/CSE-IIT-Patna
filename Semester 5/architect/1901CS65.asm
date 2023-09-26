# Compute the sum of N integers: 1 + 2 + 3 + ... + N

# data segment
.data

output1:	.asciiz	"Please enter N ->  "
output2:	.asciiz	"Sum of first N numbers -> "

# Code Segment
.text
.globl	main

main:
	# Initialize registers
	li	$t1, 0		# Initialize the counter (i)
	li	$t2, 0		# Initialize sum

	# Print the message of output1
	li	$v0,4		# print_string syscall code = 4
	la	$a0, output1	# load output1 into register $a0
	syscall

	# Input N from user and store in register
	li	$v0,5		# read_int syscall code = 5
	syscall	
	move	$t0,$v0		# syscall results returned in $v0

	# Run a loop till N
loop:	addi	$t1, $t1, 1	# i = i + 1
	add	$t2, $t2, $t1	# sum = sum + i
	beq	$t0, $t1, exit	# if i = N, continue
	j	loop

	# Exit routine - print output2
exit:	li	$v0, 4		# print_string syscall code = 4
	la	$a0, output2	# load output2 into register a0
	syscall

	# Print the message of output2
	li	$v0,1		# print_int syscall code = 1
	move	$a0, $t2
	syscall

	li	$v0,10		# exit
	syscall

