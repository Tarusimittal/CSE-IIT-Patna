#include <bits/stdc++.h>
using namespace std;

// A class of a single processes
class Process {
public:
	int pid;	// Process ID
	int wt;		// Waiting Time
	int tat;	// Turn Around Time
	int st 	;	//start Time
	int arrivalTime;	// Arrival Time
	int burstTime;		// Burst Time
	int finishTime;		// Finish Time
	int priorityNo;
};

bool comparePriority(Process p1, Process p2);
bool compareArrival(Process p1, Process p2);
void fcfs(vector<Process> &processes);
void printingAvg(vector<Process> &processes);
void np_priority(vector<Process> &processes);

int main(){
	
	cout<<"Write the no of processes(n): ";
	int n;  //no of processes
	cin >> n;						
	
	vector<Process> processes(n); //vector to store the data of processes
	
	for (int i = 0; i < n; i++){
		processes[i].pid = i + 1;
		cin >> processes[i].arrivalTime >> processes[i].burstTime >> processes[i].priorityNo;
	}

	// To find the waiting time and turn around time for all the proceeses
	np_priority(processes);
	
	// To print the waiting time and turn around time for all the proceeses
	printingAvg(processes);
}

// To sort according to the finish times 
bool compareFinish(Process p1, Process p2){
	return p1.finishTime < p2.finishTime;
}

	
void np_priority(vector<Process> &processes) {
	int n = processes.size();
	int current_time = 0;
    int completed = 0;
    int prev = 0;

	// Vector to check if a processes is completed or not
	vector<int> is_completed(n, 0);

	// Run loop till all processes are completed
    while(completed != n) {
        int idx = -1;
        int mn = INT_MAX;

		/* Find processes with highest priority (lowest priority number) 
		among processes that are in ready queue arrivalTime current_time */
        for(int i = 0; i < n; i++) {
            if(processes[i].arrivalTime <= current_time && is_completed[i] == 0) {
                if(processes[i].priorityNo < mn) {
                    mn = processes[i].priorityNo;
                    idx = i;
                }
                if(processes[i].priorityNo == mn) {
                    if(processes[i].arrivalTime < processes[idx].arrivalTime) {
                        mn = processes[i].priorityNo;
                        idx = i;
                    }
                }
            }
        }

		// If such a processes is found, calculate ST, FT TAT & WT for it
        if(idx != -1) {
            processes[idx].st = current_time;
            processes[idx].finishTime = processes[idx].st + processes[idx].burstTime;
            processes[idx].tat = processes[idx].finishTime - processes[idx].arrivalTime;
            processes[idx].wt = processes[idx].tat - processes[idx].burstTime;

            is_completed[idx] = 1;
            completed++;
            current_time = processes[idx].finishTime;
            prev = current_time;
        }
		// If no such processes are found, increment current time
        else {
            current_time++;
        }
    }
	return;
}

/* Print average WT and average TAT */
void printingAvg(vector<Process> &processes){
	double waitingTimeAvg = 0.0;
	double turnAroundAvg = 0.0;
	int n = processes.size();

	//we add all the avg wt and tat
	//so that we can find teh avg by diving by n
	for(auto p: processes){
		waitingTimeAvg = waitingTimeAvg + p.wt;
		turnAroundAvg = turnAroundAvg + p.tat;
	}

	//because we want 2decimal places
    cout << fixed << setprecision(2);
	waitingTimeAvg /= n;
	turnAroundAvg /= n;
	cout << waitingTimeAvg << " " << turnAroundAvg << endl;

	//We first sort the vector according to their finish times
	sort(processes.begin(), processes.end(), compareFinish);

	for (int i = 0; i < n; i++){
		cout << "P" << processes[i].pid << " ";
	}
	cout << endl;

	return;
}