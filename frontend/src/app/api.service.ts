import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
 API_KEY = '30b1a7dd87354ee9876bb7f2d0716716';
 constructor(private httpClient: HttpClient) { }
 
}
