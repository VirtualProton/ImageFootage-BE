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

export class Search{
  productType: number;
  search: string;
  letest:number;
  curated:number;
  populer:number;
  product_colors :any;
  product_gender:any;
  product_ethinicities:any;
  product_imagesizes:any;
  product_people:any;
  product_locations:any;
  product_imagetypes:any;
  product_orientation:any;
  product_sortType:any;
  product_editorial:any;
  pagenumber:number;
  durationless:any;
  durationgrt:any;
  searchFilter:any;
  tolerance:any;
}

export class aosSlider{
  id:number;
  product_title:string;
  product_main_image:any;
  product_main_type:string;
  description:any;
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
