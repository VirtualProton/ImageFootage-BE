import { Component, OnInit } from '@angular/core';
import { JarwisService } from '../../services/jarwis.service';
import { TokenService } from '../../services/token.service';
import { Router } from '@angular/router';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

productTypes = [
  {name: 'Images', id: '1' },
  {name: 'Footage', id: '2' },
  {name: 'Image & Footage Both', id: '3' }
];
  public form = {
    search: null,
    productType: null
  };
  public error = null;

  constructor(
    private Jarwis: JarwisService,
    private router: Router
    ) {}

  onSubmit() {
    this.Jarwis.search(this.form).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    );
  }

  handleResponse(data) {
   this.router.navigateByUrl('/searchlist');
  }

  handleError(error) {
    this.error = error.error.error;
  }
   ngOnInit() {
  }

}
