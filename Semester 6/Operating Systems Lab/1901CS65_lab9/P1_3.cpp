#include <bits/stdc++.h>

using namespace std;

/* Function to print frame contents at any instant of time */
void printFrames(vector<int> frame, int f, int time);

/*	Function to simulate Optimal page replacement */
void optimal(int f, vector<int> page_order);

int main() {
	int n;cin>>n;
	int x;
	vector<int> arr;
	while(cin>>x){
		arr.push_back(x);
	}

	cout<<"OPTIMAL" << ":\n";
    for (auto ele: arr) {
        cout << ele << " ";
    }
    cout << "\nFrame content at each time step t\n";
    for (int i = 0; i < n; i++) {
        cout << "F" << i + 1 << "\t";
    }
    cout << endl;
	
    optimal(n, arr);   
}

void printFrames(vector<int> frame, int f, int time) {
    int N = frame.size();
    for (int i = 0; i < f; i++) {
        if (i < N) cout << frame[i] << "\t";
        else cout << "X\t";
    }
    cout << "at t = " << time << endl;
    return;
}
void optimal(int f, vector<int> page_order) {
    vector<int> frame;
    int time = 0, page_faults = 0;
    int N = page_order.size();

    
    printFrames(frame, f, time);

    for (int i = 0; i < N; i++) {
        time++;
        if (find(frame.begin(), frame.end(), page_order[i]) == frame.end()) {
            page_faults++;
            if (frame.size() < f) 
            	frame.push_back(page_order[i]);
            else {
            	int idx = 0;
                int longest_wait = 0;
                for (int j = 0; j < frame.size(); j++) {
                    int wait = INT_MAX;
                    for (int k = i + 1; k < N; k++) {
                        if (page_order[k] == frame[j]) {
                            wait = k - i;
                            break;
                        }
                    }
                    if (wait > longest_wait) {
                        longest_wait = wait;
                        idx = j;
                    }
                }
                frame[idx] = page_order[i];
            }
        }
        printFrames(frame, f, time);
    }
    cout << "\n#Page Faults: " << page_faults << endl;
    return;
}