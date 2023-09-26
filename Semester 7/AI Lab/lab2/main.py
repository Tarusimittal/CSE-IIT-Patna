import sys
import numpy as np
from input_output import readInput, printOptimalPath, printMat
from helper import string_to_mat, mat_to_string
from helper_class import Matrix
from a_star	import a_star

import time

if __name__ == '__main__':
	# Handling incorrect command line arguments
	if len(sys.argv) != 3:
		print('Error: Incorrect Input format.')
		print('Run: main.py <path_to_initial_state> <path_to_final_state>')
		exit(0)
	start_state = Matrix(np.array(readInput(sys.argv[1])))
	goal_state = Matrix(np.array(readInput(sys.argv[2])))
		
	print('Enter the type of Hueristic function:')
	print('1. h1(n) = 0, Zero heuristic')
	print('2. h2(n) = Number of tiles displaced from their destined position.')
	print('3. h3(n) = Sum of Manhattan distance of each tile from the goal')
	print('4. h4(n) = h(n) > h*(n)')
	print("")
	hueristic_used = int(input())


	start_time = time.time()
	closed_list, parent_list, optimal_path_cost = a_star(start_state, goal_state, hueristic_used)
	end_time = time.time()

	if optimal_path_cost != -1:
		print("Found a solution to the puzzle !")
		print("")
		print("")
		print("Start State of the Puzzle:")
		printMat(start_state.mat)
		print("")
		print("")
		print("Goal State of the Puzzle:")
		printMat(goal_state.mat)
		print("")
		print("")
		print(f"Total number of states explored: {len(closed_list)}")
		print(f"Total number of states to Optimal Path: {optimal_path_cost + 1}")
		print(f"Optimal Path Cost: {optimal_path_cost}")
		print(f"Time taken: {end_time - start_time}")
		print("")
		printOptimalPath(parent_list, mat_to_string(goal_state.mat), mat_to_string(start_state.mat))
	else:
		print("OOPS ! The program was unable to find a solution !")		
		print("")
		print("")
		print("Start State of the Puzzle:")
		printMat(start_state.mat)
		print("")
		print("")
		print("Goal State of the Puzzle:")
		printMat(goal_state.mat)
		print("")
		print("")
		print(f"Total number of states explored before ending the program: {len(closed_list)}")