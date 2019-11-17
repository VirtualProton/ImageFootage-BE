import { InMemoryDbService } from 'angular-in-memory-web-api';
import { Hero } from './hero';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class InMemoryDataService implements InMemoryDbService {
  createDb() {
    const heroes = [
      { id: 11, name: 'Dr Nice' },
      { id: 12, name: 'Narco' },
      { id: 13, name: 'Bombasto' },
      { id: 14, name: 'Celeritas' },
      { id: 15, name: 'Magneta' },
      { id: 16, name: 'RubberMan' },
      { id: 17, name: 'Dynama' },
      { id: 18, name: 'Dr IQ' },
      { id: 19, name: 'Magma' },
      { id: 20, name: 'Tornado' }
    ];
    
    const carouselImages =[
      {id:1, categoryNames:
        [
        { id: 11, name: 'Skin Care' },
        { id: 12, name: 'Cannabis' },
        { id: 13, name: 'Business' },
        { id: 14, name: 'Curated' },
        { id: 15, name: 'Video' },
        { id: 16, name: 'Autumn' },
        ]
      },
      {id:2, categoryNames:
        [
        { id: 21, name: 'Family' },
        { id: 22, name: 'Halloween' },
        { id: 23, name: 'Seniors' },
        { id: 24, name: 'Cats & Dogs' },
        { id: 25, name: 'Time to Party' },
        { id: 26, name: 'Food' }
        ]
      },
      {id:3, categoryNames:
        [
        { id: 31, name: 'The Digital Frontier' },
        { id: 32, name: 'Christmas' },
        { id: 33, name: 'Real People & Places' },
        { id: 34, name: 'Art & Concept' }
        ]
      }
    ];

    const aosImages= [
      { id:1,name:'test1',imageName:"img_4.jpg",type:'photo',count:42},
      { id:2,name:'test2',imageName:"img_1.jpg",type:'photo',count:42},
      { id:3,name:'test3',imageName:"img_2.jpg",type:'photo',count:42},
      { id:4,name:'test4',imageName:"img_3.jpg",type:'photo',count:42},
      { id:5,name:'test5',imageName:"xcJtL7QggTI",type:'video',count:42},
      { id:6,name:'test6',imageName:"img_5.jpg",type:'photo',count:42},
      { id:7,name:'test7',imageName:"img_6.jpg",type:'photo',count:42},
      { id:8,name:'test8',imageName:"img_7.jpg",type:'photo',count:42},
      { id:9,name:'test9',imageName:"img_8.jpg",type:'photo',count:42},
      { id:10,name:'test10',imageName:"img_9.jpg",type:'photo',count:42},
      { id:11,name:'test11',imageName:"img_10.jpg",type:'photo',count:42},
      { id:12,name:'test12',imageName:"img_1.jpg",type:'photo',count:42},
      { id:13,name:'test13',imageName:"img_2.jpg",type:'photo',count:42},
      { id:14,name:'test14',imageName:"img_3.jpg",type:'photo',count:42},
      { id:15,name:'test15',imageName:"img_4.jpg",type:'photo',count:42},
      { id:16,name:'test16',imageName:"img_5.jpg",type:'photo',count:42},
      { id:17,name:'test17',imageName:"img_6.jpg",type:'photo',count:42},
      { id:18,name:'test18',imageName:"img_7.jpg",type:'photo',count:42},
      { id:19,name:'test19',imageName:"img_8.jpg",type:'photo',count:42},
      { id:20,name:'Amar',imageName:"img_9.jpg",type:'photo',count:42},
    ]

    const userData=[
      { id: 1, firstName: 'test',lastName:'user1',email:'test1@user.com',password:'test1' },
      { id: 2, firstName: 'test',lastName:'user2',email:'test2@user.com',password:'test2' },
      { id: 3, firstName: 'test',lastName:'user3',email:'test3@user.com',password:'test3' },
      { id: 4, firstName: 'test',lastName:'user4',email:'test4@user.com',password:'test4' },
      { id: 5, firstName: 'test',lastName:'user5',email:'test5@user.com',password:'test5' },
      { id: 6, firstName: 'test',lastName:'user6',email:'test6@user.com',password:'test6' },
      { id: 7, firstName: 'test',lastName:'user7',email:'test7@user.com',password:'test7' }
    ];

    const cartItemsData=[
      {id:1,name:'IMAGE #2750011',size:'X-Large (6720 X 4480PX)',info:"A royalty free license for advertising, promotional and editorial use for one user. Print copies are limited to 500,000 and web use is unlimited.",price:200,imgPath:'cart-1.jpg'},
      {id:2,name:'IMAGE #2750011',size:'Small (200 X 450PX)',info:"A royalty free license for advertising, promotional and editorial use for one user. Print copies are limited to 500,000 and web use is unlimited.",price:200,imgPath:'cart-2.jpg'},
      {id:1,name:'IMAGE #2750011',size:'X-Large (6720 X 4480PX)',info:"A royalty free license for advertising, promotional and editorial use for one user. Print copies are limited to 500,000 and web use is unlimited.",price:200,imgPath:'cart-3.jpg'}
    ]

    const detailPageInfo=[{
      id:1,
      name:'Photos Title Here',
      impagePath:'wallpaper.jpg',
      photoCount:42,
      description:'Silhouetted Girls In Dark Light During Snow Fall',
      shortInfo:'silhouetted girls in dark light during snowfall (note: visible grain from high ISO)',
      keywords:[
        {id:1,name:'underwater'},
        {id:2,name:'backlit'},
        {id:3,name:'light'},
        {id:4,name:'water'},
        {id:5,name:'dark'},
        {id:6,name:'shadow'},
        {id:7,name:'clothing'},
        {id:8,name:'nature'},
        {id:9,name:'wear'}
      ],
      licenseCost:[
        {id:1,cost:15,name:'small'},
        {id:2,cost:30,name:'Medium'},
        {id:3,cost:75,name:'Large'},
        {id:4,cost:125,name:'x-Large'}
      ],
      extendedLicense:[
        {id:1,name:'Unlimited Print',amount:300},
        {id:2,name:'Products Fir Resale',amount:500},
        {id:3,name:'Multi-Seat (Unlimited)',amount:100}
      ],
      duration:'',
      likesCount:20

    }];

    const marketFreeze=[
      {id:1,name:'Item I',value:'Item I'},
      {id:2,name:'Item II', value:'Item II'},
      {id:3,name:'Item III',value:'Item III'},
      {id:4,name:'Item IV',value:'Item IV'},
      {id:5,name:'Item V',value:'Item V'},
      {id:6,name:'other',value:'other'}
    ]

    const detailPageCarouselImages =[
      {id:1,categoryLabel:'The Digital Frontier',categoryImages:
        [
        { categoryId: 1, name: 'Skin Care',imageName:"img_4.jpg",type:'photo',count:42},
        { categoryId: 2, name: 'Cannabis',imageName:"img_1.jpg",type:'photo',count:42 },
        { categoryId: 3, name: 'Business',imageName:"img_2.jpg",type:'photo',count:42 },
        { categoryId: 4, name: 'Curated',imageName:"img_3.jpg",type:'photo' ,count:42},
        { categoryId: 5, name: 'Video' ,imageName:"xcJtL7QggTI",type:'video',count:42},
        { categoryId: 6, name: 'Autumn',imageName:"img_5.jpg",type:'photo' ,count:42},
        { categoryId: 7, name: 'Family',imageName:"img_6.jpg",type:'photo' ,count:42},
        { categoryId: 8, name: 'Halloween',imageName:"img_7.jpg",type:'photo' ,count:42},
        { categoryId: 9, name: 'Seniors' ,imageName:"img_8.jpg",type:'photo',count:42},
        { categoryId: 10, name: 'Cats & Dogs',imageName:"img_9.jpg",type:'photo',count:42 },
        { categoryId: 11, name: 'Time to Party',imageName:"img_10.jpg",type:'photo',count:42 },
        { categoryId: 12, name: 'Food',imageName:"xcJtL7QggTI",type:'video',count:42 },
        { categoryId: 13, name: 'Cannabis',imageName:"img_1.jpg",type:'photo',count:42 },
        { categoryId: 14, name: 'Business',imageName:"img_2.jpg",type:'photo' ,count:42}
        ]
      }   
    ];

    return {heroes,carouselImages,aosImages,userData,detailPageCarouselImages,detailPageInfo,marketFreeze,cartItemsData};
  }

  // Overrides the genId method to ensure that a hero always has an id.
  // If the heroes array is empty,
  // the method below returns the initial number (11).
  // if the heroes array is not empty, the method below returns the highest
  // hero id + 1.
  genId(heroes: Hero[]): number {
    return heroes.length > 0 ? Math.max(...heroes.map(hero => hero.id)) + 1 : 11;
  }


}
