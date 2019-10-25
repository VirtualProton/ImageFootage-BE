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
      { id:1,name:'test2',imageName:"img_1.jpg",type:'photo',count:42},
      { id:1,name:'test3',imageName:"img_2.jpg",type:'photo',count:42},
      { id:1,name:'test4',imageName:"img_3.jpg",type:'photo',count:42},
      { id:1,name:'test5',imageName:"xcJtL7QggTI",type:'video',count:42},
      { id:1,name:'test6',imageName:"img_5.jpg",type:'photo',count:42},
      { id:1,name:'test7',imageName:"img_6.jpg",type:'photo',count:42},
      { id:1,name:'test8',imageName:"img_7.jpg",type:'photo',count:42},
      { id:1,name:'test9',imageName:"img_8.jpg",type:'photo',count:42},
      { id:1,name:'test10',imageName:"img_9.jpg",type:'photo',count:42},
      { id:1,name:'test11',imageName:"img_10.jpg",type:'photo',count:42},
      { id:1,name:'test12',imageName:"img_1.jpg",type:'photo',count:42},
      { id:1,name:'test13',imageName:"img_2.jpg",type:'photo',count:42},
      { id:1,name:'test14',imageName:"img_3.jpg",type:'photo',count:42},
      { id:1,name:'test15',imageName:"img_4.jpg",type:'photo',count:42},
      { id:1,name:'test16',imageName:"img_5.jpg",type:'photo',count:42},
      { id:1,name:'test17',imageName:"img_6.jpg",type:'photo',count:42},
      { id:1,name:'test18',imageName:"img_7.jpg",type:'photo',count:42},
      { id:1,name:'test19',imageName:"img_8.jpg",type:'photo',count:42},
      { id:1,name:'test20',imageName:"img_9.jpg",type:'photo',count:42},
    ]
    return {heroes,carouselImages,aosImages};
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
