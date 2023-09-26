from queue import PriorityQueue
from helper import  up, down, left, right
from helper_class import Matrix, Curr_State_Info
from a_star_util import h_n, find_neighbours

def a_star(initial_matrix: Matrix, goal: Matrix, heuristic_used: int):

    puzzle_start = Curr_State_Info(initial_matrix, 0, h_n(initial_matrix, goal, heuristic_used))
    # Current explored but unvisited list of states
    Explored_But_Not_Visited = PriorityQueue()
    Explored_But_Not_Visited.put(puzzle_start)
    
    closed_list = {}
    parent_list = {}

    optimal_path_cost = -1
    
    Matrix_hash = ''.join(str(val) for row in puzzle_start.state.mat for val in row)
    closed_list[Matrix_hash] = 0
    while Explored_But_Not_Visited.qsize() > 0:
        current_matrix: Curr_State_Info = Explored_But_Not_Visited.get()
        Matrix_hash = ''.join(str(val) for row in current_matrix.state.mat for val in row)
        
        if Matrix_hash not in closed_list:
            closed_list[Matrix_hash] = current_matrix.g_n
        else:
            closed_list[Matrix_hash] = min(closed_list[Matrix_hash], current_matrix.g_n)

        if (current_matrix.state.mat == goal.mat).all():
            optimal_path_cost = current_matrix.g_n
            break
            
        neighbours = find_neighbours(current_matrix)
        for neighbour in neighbours:
            if neighbour is None:
                continue
            neighbour_hash = ''.join(str(val) for row in neighbour.mat for val in row)

            if neighbour_hash not in closed_list:
                parent_list[neighbour_hash] = Matrix_hash
                closed_list[neighbour_hash] = current_matrix.g_n + 1
                Explored_But_Not_Visited.put(Curr_State_Info(neighbour, current_matrix.g_n + 1, h_n(neighbour, goal, heuristic_used)))
                
            elif current_matrix.g_n + 1 < closed_list[neighbour_hash]:
                parent_list[neighbour_hash] = Matrix_hash
                closed_list[neighbour_hash] = current_matrix.g_n + 1
                Explored_But_Not_Visited.put(Curr_State_Info(neighbour, current_matrix.g_n + 1, h_n(neighbour, goal, heuristic_used)))
                
    return closed_list, parent_list, optimal_path_cost