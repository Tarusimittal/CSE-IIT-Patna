#include <bits/stdc++.h>

using namespace std;

void Print_frame(vector<int> frame, int f, int time) {
    for (int i = 0; i < f; i++) {
        if (frame[i]!=-1) cout << frame[i] << "\t";
        else cout << "X\t";
    }
    cout << "at t = " << time << endl;
    return;
}

queue<int> q;
set<int> s;

void fifo(int f, vector<int> arr) {
   int t=0;
   vector<int> frame(f);
   for(int i=0;i<f;i++){
   	frame[i]=-1;
   }
   Print_frame(frame,f,t);
   int n=arr.size();
   int curr_ind = 0;
   int page_fault = 0;
   for(int i=0;i<n;i++){
   	t++;
   	int curr = arr[i];

   	if(s.find(curr)!=s.end()){
   		Print_frame(frame,f,t);
   		continue;
   	}
   	page_fault++;
   	s.insert(curr);
   	q.push(curr);
   	int sz = frame.size();
   	if(frame[curr_ind]==-1){
   		frame[curr_ind] = curr;
   		curr_ind++;
   		curr_ind%=f;
   		Print_frame(frame,f,t);
   		continue;
   	}
   	int fr = q.front();
   	q.pop();
   	s.erase(s.find(fr));
   	frame[curr_ind%f] = curr;
   	curr_ind++;
   	curr_ind%=f;
   	Print_frame(frame,f,t);

   }

   cout<<endl<<"Number of page defaults: "<<page_fault<<endl;
}


int main() {
	int n;cin>>n;
	int a;
	vector<int> arr;
	while(cin>>a){
		arr.push_back(a);
	}

	cout<<"FIFO" << ":\n";
    for (auto ele: arr) {
        cout << ele << " ";
    }
    cout << "\nFrame content at each time step t\n";
    for (int i = 0; i < n; i++) {
        cout << "F" << i + 1 << "\t";
    }
    cout << endl;

    fifo(n, arr);
}