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
    return {heroes,carouselImages,aosImages,userData};
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
