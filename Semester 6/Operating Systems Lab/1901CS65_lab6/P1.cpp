#include <bits/stdc++.h>
using namespace std;

// A class of a single processes
class Process {
public:
	int pid;	// Process ID
	int wt;		// Waiting Time
	int tat;	// Turn Around Time
	int arrivalTime;	// Arrival Time
	int burstTime;		// Burst Time
	int finishTime;		// Finish Time
};

bool compareFinish(Process p1, Process p2);
bool compareArrival(Process p1, Process p2);
void fcfs(vector<Process> &processes);
void printingAvg(vector<Process> &processes);

int main(){
	
	cout<<"Write the no of processes(n): ";
	int n;  //no of processes
	cin >> n;						
	
	vector<Process> processes(n); //vector to store the data of processes
	
	for (int i = 0; i < n; i++){
		processes[i].pid = i + 1;
		cin >> processes[i].arrivalTime >> processes[i].burstTime;
	}

	// To find the waiting time and turn around time for all the proceeses
	fcfs(processes);
	
	// To print the waiting time and turn around time for all the proceeses
	printingAvg(processes);
}

// To sort according to the finish times 
bool compareFinish(Process p1, Process p2){
	return p1.finishTime < p2.finishTime;
}

// To sort according to the arrival times 
bool compareArrival(Process p1, Process p2){
	if (p1.arrivalTime == p2.arrivalTime){
		return p1.pid < p2.pid;
	} 
	else{
		return p1.arrivalTime < p2.arrivalTime;
	}
}

// First Come First Serve Algorithm
void fcfs(vector<Process> &processes){
	int n = processes.size();
	int time = 0;
	
	//We first sort the vector according to their arrival times
	sort(processes.begin(), processes.end(), compareArrival);
	
	//We iterate for all the processes
	//And maintain a turn around time and finish time variable
	//That we have declared while making our class process
	//So that we can use them later to find our average of tat and wt
	for (int i = 0; i < n; i++){
		time = max(processes[i].arrivalTime, time);
		processes[i].wt = time - processes[i].arrivalTime;
		time = time + processes[i].burstTime;
		processes[i].finishTime = time;
		processes[i].tat = processes[i].finishTime - processes[i].arrivalTime;
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