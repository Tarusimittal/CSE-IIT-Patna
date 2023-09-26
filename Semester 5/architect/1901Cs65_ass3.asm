# Program to find smallest number from an array


# Data segment

.data
	space:	.asciiz " "
	.align 2
	list:		.space 40
	msgs:	.asciiz "Please Enter 10 Numbers: "
	msge: .asciiz "The minimum number is: "


# Text segment

.text
.globl	main

main:
	# Print the message in the start string
	li	$v0, 4
	la	$a0, msgs	      # load the msg into a0
	syscall

	la 	$t1, list	      #t1 is the initial pointer
	addi 	$t2, $t1, 40	#t2 is the pointer to the last element
	addi 	$t3, $t1, 0   #t3 is teh current pointer

input:
	bge	$t3,$t2,end1     #ends when t3 = t2
	li 	$v0,5            #inputs from the user
	syscall
	sw 	$v0, 0($t3)			#arr[t3]=v0
	addi 	$t3, $t3, 4   #next element
	j 	input;


end1:
	addi 	$t3, $t1, 0     # t3= t1
	lw 	$t4, 0($t1)       # t4 stores the minimum
	addi 	$t2, $t2, -4    #to check the out of bound condition

minloop:
	bge 	$t3, $t2, end2      #if t3=t2 then exit
	lw 	$t5, 4($t3)           #t5=arr[t3+1]
	blt 	$t5, $t4, curmin    # if t4>t5 then current min changes
	jal 	swapnum             # if t4<t5

curmin:
	addi 	$t3, $t3, 4         #t3=t3+1 implies t3=t5
	lw 	$t4, 0($t3)           #t4=t3 ->t4=t5
	j 	minloop

end2:
# Print the message in end message string
	li	$v0, 4
	la	$a0, msge	          # load the msg into a0
	syscall

	li 	$v0, 1
	lw 	$a0, 0($t2)
	syscall

	li	$v0, 10		# exit
	syscall

swapnum:
	lw 	$s1, 4($t3)   # s1 stores t5
	lw 	$s2, 0($t3)   # s2 stores t4
	sw 	$s1, 0($t3)   # s1 now stores t4
	sw 	$s2, 4($t3)   # s2 now stores t5
	jr 	$ra
