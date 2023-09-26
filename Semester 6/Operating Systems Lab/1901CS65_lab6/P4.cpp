#include <bits/stdc++.h>
#define TIME_QUANTUM 1
using namespace std;

// A class of a single processes
class Process {
public:
	int pid;	// Process ID
	int wt;		// Waiting Time
	int tat;	// Turn Around Time
	int remainingTime;		// Remaining Time
	int arrivalTime;	// Arrival Time
	int burstTime;		// Burst Time
	int finishTime;		// Finish Time
};

bool compareFinish(Process p1, Process p2);
bool compareArrival(Process p1, Process p2);
void hrtf(vector<Process> &processes);
void printingAvg(vector<Process> &processes);

/* Operator overloading to sort according to burst times */
struct compareRemaining{
	bool operator()(Process* p1, Process* p2) {
		if (p1 -> remainingTime == p2 -> remainingTime){
			return p1 -> pid > p2 -> pid;
		} 
		return p1 -> remainingTime < p2 -> remainingTime;
	}
};

int main(){
	
	cout<<"Write the no of processes(n): ";
	int n;  //no of processes
	cin >> n;						
	
	vector<Process> processes(n); //vector to store the data of processes
	
	for (int i = 0; i < n; i++){
		processes[i].pid = i + 1;
		cin >> processes[i].arrivalTime >> processes[i].burstTime;
		processes[i].remainingTime = processes[i].burstTime;
	}

	// To find the waiting time and turn around time for all the proceeses
	hrtf(processes);
	
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

// Highest Remaining Time First Algorithm
void hrtf(vector<Process> &processes) {
	int n = processes.size();
	int currentQueue = 0;
	int time = 0;

	// We sort the vector according to the arrival times
	sort(processes.begin(), processes.end(), compareArrival);

	priority_queue<Process*, vector<Process*>, compareRemaining> q;

	while (true) {
		
		if (q.empty() && currentQueue == n){
			break;  //we break if all are completed
		} 

		// If queue is empty, increase time
		if (q.empty()) time = max(time, processes[currentQueue].arrivalTime);

		// Push all processes whose arrival time <= time
		while (time >= processes[currentQueue].arrivalTime && currentQueue < n){
			q.push(&processes[currentQueue]);
			currentQueue++;
		}
		
		// Extract shortest remaining burst time processes
		Process* p = q.top();
		q.pop();

		// Calculate WT, finishTime, TAT, remainingTime (Update burstTime), LET
		time += min(TIME_QUANTUM, p -> remainingTime);
		p -> remainingTime -= min(TIME_QUANTUM, p -> remainingTime);
		if (p -> remainingTime == 0) {
			p -> finishTime = time;
			p -> tat = p -> finishTime - p -> arrivalTime; 
			p -> wt = p -> tat - p -> burstTime;
		} else q.push(p);
	} 
	
	return;
}
