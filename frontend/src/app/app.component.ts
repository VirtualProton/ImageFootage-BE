import { Component } from '@angular/core';
import { AuthService, FacebookLoginProvider, SocialUser } from 'angularx-social-login';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  title = 'frontend';
  user: SocialUser;
  loggedIn: boolean;
  constructor(private authService: AuthService) { }
  signInWithFB(): void {
  	this.authService.signIn(FacebookLoginProvider.PROVIDER_ID);
  }
  signOut(): void {
	  this.authService.signOut();
  }
  ngOnInit() {
	  this.authService.authState.subscribe((user) => {
		this.user = user;
		this.loggedIn = (user != null);
		console.log(this.user);
	  });
 }
}
