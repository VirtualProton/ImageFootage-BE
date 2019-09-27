import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HttpClientModule } from '@angular/common/http';
import { ProductComponent } from './product/product.component';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule } from '@angular/forms';
const appRoutes: Routes = [
  {
    path: 'products',
    component: ProductComponent,
    data: { title: 'Product List' }
  },
  { path: '',
    redirectTo: '/products',
    pathMatch: 'full'
  }
];
@NgModule({
  declarations: [
    AppComponent,
    ProductComponent
  ],
  imports: [
    RouterModule.forRoot(appRoutes),
  	FormsModule,
 	BrowserModule,
  	HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
