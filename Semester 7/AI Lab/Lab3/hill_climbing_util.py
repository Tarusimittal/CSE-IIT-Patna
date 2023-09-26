from queue import PriorityQueue
from helper import up, down, left, right
from helper_class import Matrix, Curr_State_Info

# **************************** Heuristic Function **************************** #

# displaced tiles heuristic
def displaced_tiles_heuristic(current_state: Matrix, goal_state: Matrix):
    h_current_state = 0
    for i in range(3):
        for j in range(3):
        	if current_state.mat[i][j] != goal_state.mat[i][j]:
        		h_current_state += 1
    return h_current_state

# manhattan distance hueristic
def manhattan_heuristic(current_state: Matrix, goal_state: Matrix):
    h_current_state = 0
    real_row = [0, 0, 0, 0, 0, 0, 0, 0, 0]
    real_col = [0, 0, 0, 0, 0, 0, 0, 0, 0]
    for i in range(3):
        for j in range(3):
            real_row[goal_state.mat[i][j] ] = i
            real_col[goal_state.mat[i][j] ] = j
    for i in range(3):
        for j in range(3):
        	val = current_state.mat[i][j]
        	h_current_state += abs(real_row[val] - i) + abs(real_col[val] - j)
    return h_current_state

# **************************** Helper function **************************** #
def h_n(current_matrix, goal, heuristic_used: int):
	if heuristic_used == 1:
		return displaced_tiles_heuristic(current_matrix, goal)
	elif heuristic_used == 2:
		return manhattan_heuristic(current_matrix, goal)

def find_neighbours(puzzle_state: Curr_State_Info):
    neighbours = [
        up(puzzle_state.state),
        down(puzzle_state.state),
        left(puzzle_state.state),
        right(puzzle_state.state)
    ]
    return neighbours

# *************************************************************************************** #