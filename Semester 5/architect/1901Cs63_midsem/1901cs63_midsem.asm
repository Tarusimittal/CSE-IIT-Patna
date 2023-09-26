

#####################################################################################
####           Recursive Quick Sort to find kth smallest element                 ####
#####################################################################################


######################## C code ###########################
##
##	void quick(int *arr, int left, int right) {
##		int l = left, r = right, p = left;
##		
##		while (l < r) {
##			while (arr[l] <= arr[p] && l < right)
##				l++;
##			while (arr[r] >= arr[p] && r > left)
##				r--;
##			if (l >= r) {
##				SWAP(arr[p], arr[r]);
##				quick(arr, left, r - 1);
##				quick(arr, r + 1, right);
##				return;
##			}
##			SWAP(arr[l], arr[r]);
##		}
##	}
##
###########################################################

.data
	Array:		.word	86, 179, 40, -77, 0, -5, 16, 3, 7, 9, 8, -17, 98, -1, 158, -95
	Array_size:	.space	4
	sz:		.asciiz	"Size of the array: "
	find:		.asciiz	"K: "
	msg1:		.asciiz	"Unsorted array: "
	msg2:		.asciiz	"Sorted array: "
	msg3:		.asciiz 	"Kth smallest Integer: "
	msg4:		.asciiz 	"debug"
	
	n:		.word 8									## Kth smallest element to be found 1 <= k <= size of the array
	
	space:		.asciiz	" "
	linebreak:	.asciiz	"\n"

.text
.globl main

main:
	# Print size of the array
	li	$v0, 4			# system call code 4 => print_str
	la	$a0, sz
	syscall
	

	# Find number of elements
	la	$t0, Array_size	# t0 = address of array_size
	la	$t1, Array		# t1 = initial address of the array
	sub	$t2, $t0, $t1			 
	srl	$t2, $t2, 2
	sw	$t2, 0($t0)		# Array_size = t0 => number of elements in array
	
	li	$v0, 1			# system call code 1 => print_int
	lw	$a0, 0($t0)
	syscall
	
	#Print Linebreak
	li 	$v0, 4 		# system call code 4 => print_str
	la 	$a0, linebreak
	syscall
	
	# Print msg1
	li	$v0, 4			# system call code 4 => print_str
	la	$a0, msg1
	syscall
	
	
	
	# Print UnsortedArray
	jal	PRINT
	
	# Call quick sort
	la	$a0, Array
	li	$a1, 0
	
	# a2 = Array_size - 1
	lw	$t0, Array_size
	addi	$t0, $t0, -1
	move	$a2, $t0
	
	# function call
	jal	QUICK
	
	# Print Sorted array
	li	$v0, 4			# system call code 4 => print_str
	la	$a0, msg2
	syscall

	jal	PRINT
	
########################## Print Kth smallelst ###############################	
	
	#Print Linebreak
	li 	$v0, 4 		# system call code 4 => print_str
	la 	$a0, linebreak
	syscall
	
	#Print msg3
	li 	$v0, 4 		# system call code 4 => print_str
	la 	$a0, msg3
	syscall	
	
PrintKth:
	la	$t1, Array		# t1 = initial address of array
	li	$t0, 0
	lw	$t2, n
	sub 	$t2, $t2, 1
	#lw	$t0, Array_size	# t0 = number of elements of array
	
forkth:
	beq	$t0, $t2, exit
	
	addi	$t0, $t0, 1
	addi	$t1, $t1, 4
	
	j	forkth
exit:
	li 	$v0, 1 		# system call code 1 => print_int
	lw 	$a0, 0($t1) 		
	syscall 			

	li 	$v0, 10 		# Terminate program run and
	syscall 			# Exit
	
#############################################################################

# Greater than function
greater: 
	slt $t0, $t1,$t0
	bge $t0,$zero,while
		

PRINT:
	la	$t1, Array		# t1 = initial address of array
	lw	$t0, Array_size	# t0 = number of elements of array
	
for1:
	beq	$t0, $zero, endfor1
	
	# Print element
	li	$v0, 1			# system call code 1 => print_int
	lw	$a0, 0($t1)
	syscall	
	
	# Print space
	li	$v0, 4			# system call code 4 => print_str
	la	$a0, space
	syscall
	
	addi	$t0, $t0, -1
	addi	$t1, $t1, 4
	
	j	for1
	
endfor1:
	# Print Linebreak
	li	$v0, 4
	la	$a0, linebreak
	syscall
	
	jr	$ra
	
###########################################################

######################## C code ###########################
##
##	void quick(int *arr, int left, int right) {
##		int l = left, r = right, p = left;
##		
##		while (l < r) {
##			while (arr[l] <= arr[p] && l < right)
##				l++;
##			while (arr[r] >= arr[p] && r > left)
##				r--;
##
###########################################################


QUICK:

	sub	$sp, $sp, 24		# Make room into stack sp
	sw	$s0, 0($sp)		# Push s0 into sp
	sw	$s1, 4($sp)		# Push s1 into sp
	sw	$s2, 8($sp)		# Push s2 into sp
	sw	$a1, 12($sp)		# Push a1 into sp
	sw	$a2, 16($sp)		# Push a2 into sp
	sw	$ra, 20($sp)		# Push ra into sp

	#setup
	move	$s0, $a1		# l = left
	move	$s1, $a2		# r = right
	move	$s2, $a1		# p = left

while:
	bge	$s0, $s1, Innerdone
	

InnerWhile1:                          ##### while (arr[l] <= arr[p] && l < right)
	li	$t3, 4
	# t1 = &arr[p]
	mult	$s2, $t3
	mflo	$t1			# t1 =  p * 4bit
	add	$t1, $t1, $a0		# t1 = &arr[p]
	lw	$t1, 0($t1)
	
	# t0 = &arr[l]	
	mult	$s0, $t3
	mflo	$t0			# t0 =  l * 4 bits
	
	add	$t0, $t0, $a0		# t0 = &arr[l]
	lw	$t0, 0($t0)
	
	bgt	$t0, $t1, Innerdone1	# check arr[l] <= arr[p]
	
	bge	$s0, $a2, Innerdone1	# check l < right
	
	addi	$s0, $s0, 1		# l++
	j	InnerWhile1
	
Innerdone1:

InnerWhile2:                          ##### while (arr[r] >= arr[p] && r > left)
	li	$t3, 4
	# t1 = &arr[p]
	mult	$s2, $t3
	mflo	$t1			# t1 =  p * 4bit
	add	$t1, $t1, $a0		# t1 = &arr[p]
	lw	$t1, 0($t1)
	
	# t0 = &arr[r]
	mult	$s1, $t3
	mflo	$t0			# t0 =  r * 4bit
	add	$t0, $t0, $a0		# t0 = &arr[r]
	lw	$t0, 0($t0)

	blt	$t0, $t1, Innerdone2	# check arr[r] >= arr[p]
	
	ble	$s1, $a1, Innerdone2	# check r > left

	
	addi	$s1, $s1, -1		# r--
	j	InnerWhile2
	
Innerdone2:


############################################################
##
##			if (l >= r) {
##				SWAP(arr[p], arr[r]);
##				quick(arr, left, r - 1);
##				quick(arr, r + 1, right);
##				return;
##			}
##			SWAP(arr[l], arr[r]);
##
############################################################

# if (l >= r)
	blt	$s0, $s1, jump_if
	
############### SWAP (arr[p], arr[r]) ######################
	li	$t3, 4
	
	# t1 = &arr[r]
	mult	$t3, $s1
	mflo	$t6			# t6 =  r * 4bit
	add	$t1, $t6, $a0		# t1 = &arr[r]
	
	# t0 = &arr[p]
	mult	$t3, $s2
	mflo	$t6			# t6 =  p * 4bit
	add	$t0, $t6, $a0		# t0 = &arr[p]

	jal	swap

	
#############################################################
# quicksort(arr, left, r - 1)

	move	$a2, $s1
	addi	$a2, $a2, -1		# a2 = r - 1
	jal		QUICK
	
	lw	$a1, 12($sp)		# pop a1
	lw	$a2, 16($sp)		# pop a2
	lw	$ra, 20($sp)		# pop ra
	
# quicksort(arr, r + 1, right)

	move	$a1, $s1
	addi	$a1, $a1, 1		# a1 = r + 1
	jal	QUICK
	
	lw	$a1, 12($sp)		# pop a1
	lw	$a2, 16($sp)		# pop a2
	lw	$ra, 20($sp)		# pop ra
	
	j return

#############################################################

jump_if:

# SWAP (arr[l], arr[r])
	li	$t3, 4
	
	# t1 = &arr[r]
	mult	$t3, $s1
	mflo	$t6			# t6 =  r * 4bit
	add	$t1, $t6, $a0		# t1 = &arr[r]
	
	# t0 = &arr[l]
	mult	$t3, $s0
	mflo	$t6			# t6 =  l * 4bit
	add	$t0, $t6, $a0		# t0 = &arr[l]


	jal	swap
	j	while
###############################################################
Innerdone:
	
return:

	lw	$s0, 0($sp)		# pop s0
	lw	$s1, 4($sp)		# pop s1
	lw	$s2, 8($sp)		# pop s2
	addi	$sp, $sp, 24		# remove elements from the stacks sp
	jr	$ra
	
swap:

	lw	$t3, 0($t1)
	lw	$t2, 0($t0)
	sw	$t2, 0($t1)
	sw	$t3, 0($t0)
	jr	$ra

##########################################################################
####                            END                                   ####
##########################################################################

