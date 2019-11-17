export class Hero {
  id: number;
  name: string;
}


export class carouselSlider{
  id:number;
  categoryNames:Category[];
}

export class Category{
  id: number;
  name: string;
}

export class aosSlider{
  id:number;
  name:string;
  imageName:string;
  type:string;
  count:number;
  eleClass:number;
}

export class userData{
  id:number;
  firstName:string;
  lastName:string;
  email:any;
  password:string;
}

export class carouselSliderImages{
  categoryId:number;
  categoryLabel:string;
  categoryImages:aosSlider[][];
}

export class detailPageInfo{
  id:number;
  name:string;
  impagePath:any;
  description:any;
  photoCount:number;
  shortInfo:any;
  keywords:[];
  licenseCost:[];
  extendedLicense:[];
  duration:string;
  likesCount:number;
}

export class market {
  id:number;
  name:string;
  value:string;
}

export class cartItemData {
  id:number;
  name:string;
  size:string;
  info:string;
  price:number;
  imgPath:string;
}