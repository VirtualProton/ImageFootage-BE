import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

import { Observable, of, BehaviorSubject } from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';

import { Hero, carouselSlider, aosSlider, userData, carouselSliderImages, detailPageInfo, market, cartItemData } from './hero';
import { MessageService } from './message.service';


@Injectable({ providedIn: 'root' })
export class HeroService {
   //https://imagefootage.com/backend/api/ For Live
  //http://localhost/imagefootagenew/backend/api/ For Local
  private heroesUrl = 'https://imagefootage.com/backend/api/';  // URL to web api
  private localhostUrl = 'http://localhost/imagefootagenew/backend/api/';
  private carouselImagesUrl = 'api/carouselImages';
  private aosImagesUrl = 'api/aosImages';
  private countryUrl :string = "https://raw.githubusercontent.com/sagarshirbhate/Country-State-City-Database/master/Contries.json";
  private currentUserSubject: BehaviorSubject<userData>;
  public currentUser: Observable<userData>;


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(
    private http: HttpClient,
    private messageService: MessageService) {
    this.currentUserSubject = new BehaviorSubject<userData>(JSON.parse(localStorage.getItem('currentUser')));
    this.currentUser = this.currentUserSubject.asObservable();
  }

  public get currentUserValue(): userData {
    return this.currentUserSubject.value;
  }

  allCountries(): Observable<any>{
    const url = `${this.heroesUrl}getCountyStatesCityList`;
    //return this.http.get(this.countryUrl);
    return this.http.get(url);
  }
  allstates(country): Observable<any>{
    const url = `${this.heroesUrl}getCountyStatesList/`+country;
    //return this.http.get(this.countryUrl);
    return this.http.get(url);
  }
  allCities(state): Observable<any>{
    const url = `${this.heroesUrl}getStateCityList/`+state;
    //return this.http.get(this.countryUrl);
    return this.http.get(url);
  }


  /** GET Slider Images from the server */
  getcarouselSliderImages():Observable<any> {
      const url = `${this.heroesUrl}categoryListApi`;
       let data = this.http.get(url);
       return data;
        //console.log(categories);
                  // if(data) {
                       let _carouselSlider = new carouselSlider();
                       let _carouselSliderArray = new Array<carouselSlider>();
                       _carouselSlider.id = 1;
                       _carouselSlider.categoryNames = data["0"];
                       // [{id: data[], name: 'Skin Care'}, {id: 2, name: 'Cannabis'}, {
                       //     id: 3,
                       //     name: 'Business'
                       // }, {id: 4, name: 'Curated'}, {id: 5, name: 'Video'}, {id: 6, name: 'Autumn'}]
                       _carouselSliderArray.push(_carouselSlider);
                       let _carouselSlider1 = new carouselSlider();
                       _carouselSlider1.id = 2;
                       _carouselSlider1.categoryNames = data["1"];

                       //     [{id: 11, name: 'Dr Nice'}, {id: 12, name: 'Narco'}, {
                       //     id: 13,
                       //     name: 'Bombasto'
                       // }, {id: 14, name: 'Celeritas'}, {id: 15, name: 'Magneta'}, {id: 16, name: 'RubberMan'}]
                       _carouselSliderArray.push(_carouselSlider1);
                       let _carouselSlider2 = new carouselSlider();
                       _carouselSlider2.id = 3;
                       _carouselSlider2.categoryNames = data["2"];

                       //     [{id: 21, name: 'Family'}, {id: 22, name: 'Halloween'}, {
                       //     id: 23,
                       //     name: 'Seniors'
                       // }, {id: 24, name: 'Cats & Dogs'}, {id: 25, name: 'Time to Party'}, {id: 26, name: 'Food'}]
                       _carouselSliderArray.push(_carouselSlider2);
                       let _carouselSlider3 = new carouselSlider();
                       _carouselSlider3.id = 4;
                       _carouselSlider3.categoryNames = data["4"];

                       //     [{id: 31, name: 'The Digital Frontier'}, {
                       //     id: 32,
                       //     name: 'Christmas'
                       // }, {id: 33, name: 'Real People & Places'}, {id: 34, name: 'Art & Concept'}, {
                       //     id: 35,
                       //     name: 'Magma'
                       // }, {id: 36, name: 'Tornado'}]
                       _carouselSliderArray.push(_carouselSlider3);
                       //return _carouselSliderArray;
                   //}
                  // return aosImagesUrl;
   }

  /** GET Slider Images from the server */
  /** GET Slider Images from the server */
  getAosSliderImages(): Observable<any> {
    const url = `${this.heroesUrl}home`;
    return this.http.get<any>(url)
      .pipe(
        map(aosImagesUrl => {
          return aosImagesUrl.api;
          // return aosImagesUrl;
        }),
        catchError(this.handleError<any>('getCarouselImages', []))
      );
  }

  getAosSliderSearchImages(searchData: any): Observable<any> {
    let url = `${this.heroesUrl}search`;
    /* if(searchData.productType == 2){
       url = `${this.localhostUrl}search`;
     }*/

    return this.http.post<any>(url, searchData, this.httpOptions).pipe(
      map(searchResultSet => {
        return searchResultSet.imgfootage;
      }),
      catchError(this.handleError<any>(`unable to get data`))
    );
  }

  getSearchLeftFilter(): Observable<any> {
    const url = `${this.heroesUrl}get_side_filtes`
    return this.http.get<any>(url)
      .pipe(
        map(searchSideMenu => {
          return searchSideMenu.data;
          // return aosImagesUrl;
        }),
        catchError(this.handleError<any>('searchSideMenu', []))
      );

  }



  getLogin(email: any, password: string): Observable<userData> {
    const url = `${this.heroesUrl}login`;
    return this.http.post<any>(url, { email, password }, this.httpOptions).pipe(
      map(user => {
        console.log(user);
        localStorage.setItem('currentUser', JSON.stringify(user));
        this.currentUserSubject.next(user);
        return user;
      }),
      catchError(this.handleError<userData>(`unable to get data`))
    );
  }

  register(usrData: any): Observable<any> {
    const url = `${this.heroesUrl}signup`
    return this.http.post(url, usrData, this.httpOptions).pipe(
      map(userInfo => {
        return userInfo;
      }),
      catchError(this.handleError<any>(`unable to register data`))
    );;
  }

  contributorRegister(contributorData: any): Observable<any> {
      const url = `${this.heroesUrl}contributorSignup`
      let headers = new HttpHeaders({
          'Content-Type': undefined
      });
      let options = { headers: headers };
      return this.http.post(url, contributorData).pipe(
      map(contributorInfo => {
        return contributorInfo;
      }),
      catchError(this.handleError<any>(`unable to register data`))
    );;
  }

    resendOtp(email: any, mobile:any): Observable<any> {
        const url = `${this.heroesUrl}resendOtp`
        return this.http.post(url, {email,mobile},this.httpOptions).pipe(
            map(otpInfo => {
                return otpInfo;
            }),
            catchError(this.handleError<any>(`unable to resend otp data`))
        );
    }

    verifyOtp(email: any, mobile:any,otp:any): Observable<any>{
        const url = `${this.heroesUrl}verifyOtp`
        return this.http.post(url, {email,mobile,otp},this.httpOptions).pipe(
            map(verifyInfo => {
                return verifyInfo;
            }),
            catchError(this.handleError<any>(`unable to verify data`))
        );

    }

  contactUs(contactData: any): Observable<any> {
    const url = `${this.heroesUrl}user_contactus`
    return this.http.post(url, contactData, this.httpOptions).pipe(
      map(userInfo => {
        return true;
      }),
      catchError(this.handleError<userData>(`unable to user_contactus data`))
    );;
  }

  logout() {
    localStorage.removeItem('currentUser');
    this.currentUserSubject.next(null);
  }

  getcategoryCarouselImages(categoryId: number): Observable<carouselSliderImages> {
    const url = `api/detailPageCarouselImages/?${categoryId}`;
    return this.http.get<carouselSliderImages>(url).pipe(
      tap(_ => this.log(`fetched CarouselImages id=${categoryId}`)),
      catchError(this.handleError<carouselSliderImages>(`getHero id=${categoryId}`))
    );
  }

  getDetailPagedetails(id: number, webtype: number, type: any): Observable<detailPageInfo> {
    console.log(id);
    //const url = `api/detailPageInfo/?${id}`;
    const url = `${this.heroesUrl}details/${id}/${webtype}/${type}`;
    return this.http.get<detailPageInfo>(url).pipe(
      tap(_ => this.log(`fetched detail Page Info id=${id}`)),
      catchError(this.handleError<detailPageInfo>(`getHero id=${id}`))
    );

  }

addcartItemsData(product:any): Observable<userData> {
    const url = `${this.heroesUrl}add_to_cart`;
    let tokenData =JSON.parse(product.token);
    let headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': 'Bearer '+tokenData.token });
    let options = { headers: headers };

    return this.http.post<any>(url, {product}, options).pipe(
        map(cart => {
          console.log(cart);

          //this.currentUserSubject.next(cart);
          return cart;
        }),
        catchError(this.handleError<userData>(`unable to get data`))
    );
  }
removeCartItemsData(product:any): Observable<userData> {
    console.log(product);
    const url = `${this.heroesUrl}delete_cart_item`;
    //let tokenData =JSON.parse(product.token);
    let headers = new HttpHeaders({
      'Content-Type': 'application/json'
     });
    let options = { headers: headers };
    return this.http.post<any>(url, {product}, options).pipe(
        map(cart => {
          console.log(cart);
          return cart;
        }),
        catchError(this.handleError<userData>(`unable to get data`))
    );
  }

  getcartItemsData():Observable<Array<cartItemData>>{
     //let params = new HttpParams();
    const url = `${this.heroesUrl}user_cart_list`;
    let tokenData =JSON.parse( localStorage.getItem('currentUser'));
    let headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': 'Bearer '+tokenData.access_token });
    let options = { headers: headers };
    return this.http.post<any>(url,tokenData,options).pipe(
        map(cart => {
          console.log(cart);

          //this.currentUserSubject.next(cart);
          return cart;
        }),
        catchError(this.handleError<userData>(`unable to get data`))
    );
  }



  getMarketdeatils(): Observable<market> {
    const url = `api/marketFreeze`;
    return this.http.get<market>(url).pipe(
      tap(_ => this.log(`fetched market Info id`)),
      catchError(this.handleError<market>(`getHero id`))
    );
  }



  /** GET heroes from the server */
  getHeroes(): Observable<Hero[]> {
    return this.http.get<Hero[]>(this.heroesUrl)
      .pipe(
        tap(_ => this.log('fetched heroes')),
        catchError(this.handleError<Hero[]>('getHeroes', []))
      );
  }

  /** GET hero by id. Return `undefined` when id not found */
  getHeroNo404<Data>(id: number): Observable<Hero> {
    const url = `${this.heroesUrl}/?id=${id}`;
    return this.http.get<Hero[]>(url)
      .pipe(
        map(heroes => heroes[0]), // returns a {0|1} element array
        tap(h => {
          const outcome = h ? `fetched` : `did not find`;
          this.log(`${outcome} hero id=${id}`);
        }),
        catchError(this.handleError<Hero>(`getHero id=${id}`))
      );
  }

  /** GET hero by id. Will 404 if id not found */
  getHero(id: number): Observable<Hero> {
    const url = `${this.heroesUrl}/${id}`;
    return this.http.get<Hero>(url).pipe(
      tap(_ => this.log(`fetched hero id=${id}`)),
      catchError(this.handleError<Hero>(`getHero id=${id}`))
    );
  }

  /* GET heroes whose name contains search term */
  searchHeroes(term: string): Observable<Hero[]> {
    if (!term.trim()) {
      // if not search term, return empty hero array.
      return of([]);
    }
    return this.http.get<Hero[]>(`${this.heroesUrl}/?name=${term}`).pipe(
      tap(_ => this.log(`found heroes matching "${term}"`)),
      catchError(this.handleError<Hero[]>('searchHeroes', []))
    );
  }

  //////// Save methods //////////

  /** POST: add a new hero to the server */
  addHero(hero: Hero): Observable<Hero> {
    return this.http.post<Hero>(this.heroesUrl, hero, this.httpOptions).pipe(
      tap((newHero: Hero) => this.log(`added hero w/ id=${newHero.id}`)),
      catchError(this.handleError<Hero>('addHero'))
    );
  }

  /** DELETE: delete the hero from the server */
  deleteHero(hero: Hero | number): Observable<Hero> {
    const id = typeof hero === 'number' ? hero : hero.id;
    const url = `${this.heroesUrl}/${id}`;

    return this.http.delete<Hero>(url, this.httpOptions).pipe(
      tap(_ => this.log(`deleted hero id=${id}`)),
      catchError(this.handleError<Hero>('deleteHero'))
    );
  }

  /** PUT: update the hero on the server */
  updateHero(hero: Hero): Observable<any> {
    return this.http.put(this.heroesUrl, hero, this.httpOptions).pipe(
      tap(_ => this.log(`updated hero id=${hero.id}`)),
      catchError(this.handleError<any>('updateHero'))
    );
  }

  /**
   * Handle Http operation that failed.
   * Let the app continue.
   * @param operation - name of the operation that failed
   * @param result - optional value to return as the observable result
   */
  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      this.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

  /** Log a HeroService message with the MessageService */
  private log(message: string) {
    this.messageService.add(`HeroService: ${message}`);
  }

    payment(usrData: any,cartval: any,type:any): Observable<any> {
        const url = `${this.heroesUrl}payment`
        let tokenData =JSON.parse( localStorage.getItem('currentUser'));
        if(type=='atom'){
            var headers = new HttpHeaders({
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+tokenData.access_token });
            let options = { headers: headers };

            return this.http.post(url, {usrData,cartval,type,tokenData}, options).pipe(
                map(userInfo => {
                    return userInfo;
                }),
                catchError(this.handleError<any>(`unable to register data`))
            );;
        }else if(type=='payu'){
            var headers = new HttpHeaders({
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+tokenData.access_token });
            let options = { headers: headers };
            return this.http.post(url, {usrData,cartval,type,tokenData}, options).pipe(
                map(userInfo => {
                    return userInfo;
                    //console.log(JSON.stringify(userInfo));
                    //return JSON.stringify(userInfo);
                }),
                catchError(this.handleError<any>(`unable to register data`))
            );
        }

    }

    getOrderDetails(id:any):Observable<any>{
        //let params = new HttpParams();
        const url = `${this.heroesUrl}orderDetails`;
        let tokenData =JSON.parse( localStorage.getItem('currentUser'));
        let headers = new HttpHeaders({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+tokenData.access_token });
        let options = { headers: headers };
        return this.http.post<any>(url,{id},options).pipe(
            map(orderDetails => {
                console.log(orderDetails);

                //this.currentUserSubject.next(cart);
                return orderDetails;
            }),
            catchError(this.handleError<userData>(`unable to get data`))
        );
    }

    getUserprofileData():Observable<any>{
        //let params = new HttpParams();
        let tokenData =JSON.parse( localStorage.getItem('currentUser'));
        const url = `${this.heroesUrl}userprofile/`+tokenData.Utype;
        return this.http.get<any>(url).pipe(
            map(orderDetails => {
                console.log(orderDetails);

                //this.currentUserSubject.next(cart);
                return orderDetails;
            }),
            catchError(this.handleError<userData>(`unable to get data`))
        );
    }

}


