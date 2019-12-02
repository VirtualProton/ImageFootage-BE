import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

import { Observable, of, BehaviorSubject } from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';

import { Hero,carouselSlider,aosSlider, userData, carouselSliderImages, detailPageInfo, market, cartItemData } from './hero';
import { MessageService } from './message.service';


@Injectable({ providedIn: 'root' })
export class HeroService {

  private heroesUrl = 'http://localhost/imagefootagenew/backend/api/';  // URL to web api
  private carouselImagesUrl = 'api/carouselImages';
  private aosImagesUrl= 'api/aosImages';
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

    public get currentUserValue():userData{
      return this.currentUserSubject.value;
    }

    /** GET Slider Images from the server */
  getcarouselSliderImages (): Observable<any[]> {
    const url = `${this.heroesUrl}home`;
    return this.http.get<any[]>(this.carouselImagesUrl)
      .pipe(
        tap(_ => this.log('fetched carousel Images')),
        catchError(this.handleError<any[]>('getCarouselImages', []))
      );
  }

  /** GET Slider Images from the server */
 /** GET Slider Images from the server */
 getAosSliderImages (): Observable<any> {
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

getAosSliderSearchImages (searchData:any): Observable<any> {
  const url = `${this.heroesUrl}search`;

  return this.http.post<any>(url, searchData, this.httpOptions).pipe(
    map(searchResultSet => {    
      return searchResultSet.api.items;
    }),
    catchError(this.handleError<any>(`unable to get data`))
  );
}



  getLogin(email: any, password: string): Observable<userData> {
    return this.http.post<any>(`api/userData`, { email, password }, this.httpOptions).pipe(
      map(user => {
        console.log(user);
        localStorage.setItem('currentUser', JSON.stringify(user));
        this.currentUserSubject.next(user);
        return user;
      }),
      catchError(this.handleError<userData>(`unable to get data`))
    );
  }

  register(usrData: userData) : Observable<any> {
      return this.http.post(`api/userData`,usrData, this.httpOptions).pipe(
        map(userInfo => {
           return true;
        }),
        catchError(this.handleError<userData>(`unable to register data`))
      );;
  }

  logout(){
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

  getDetailPagedetails(id:number):Observable<detailPageInfo>{
    const url = `api/detailPageInfo/?${id}`;
    //const url = `${this.heroesUrl}details/srima040/3/image`;
    return this.http.get<detailPageInfo>(url).pipe(
      tap(_ => this.log(`fetched detail Page Info id=${id}`)),
      catchError(this.handleError<detailPageInfo>(`getHero id=${id}`))
    );
    
  }

  getcartItemsData():Observable<Array<cartItemData>>{
     let params = new HttpParams();
    const url = `api/cartItemsData`;
    params = params.append('actors', localStorage.getItem('checkoutAray'));
    // this.http.get(url, { params: params }) -- Modify when API integrated
    return this.http.get<Array<cartItemData>>(url).pipe(
        tap(_ => this.log(`fetched cart items data`)),
        catchError(this.handleError<Array<cartItemData>>(`getHero id`))
      );
  }



  getMarketdeatils():Observable<market>{
    const url = `api/marketFreeze`;
    return this.http.get<market>(url).pipe(
      tap(_ => this.log(`fetched market Info id`)),
      catchError(this.handleError<market>(`getHero id`))
    );
  }



  /** GET heroes from the server */
  getHeroes (): Observable<Hero[]> {
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
  addHero (hero: Hero): Observable<Hero> {
    return this.http.post<Hero>(this.heroesUrl, hero, this.httpOptions).pipe(
      tap((newHero: Hero) => this.log(`added hero w/ id=${newHero.id}`)),
      catchError(this.handleError<Hero>('addHero'))
    );
  }

  /** DELETE: delete the hero from the server */
  deleteHero (hero: Hero | number): Observable<Hero> {
    const id = typeof hero === 'number' ? hero : hero.id;
    const url = `${this.heroesUrl}/${id}`;

    return this.http.delete<Hero>(url, this.httpOptions).pipe(
      tap(_ => this.log(`deleted hero id=${id}`)),
      catchError(this.handleError<Hero>('deleteHero'))
    );
  }

  /** PUT: update the hero on the server */
  updateHero (hero: Hero): Observable<any> {
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
  private handleError<T> (operation = 'operation', result?: T) {
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
}
