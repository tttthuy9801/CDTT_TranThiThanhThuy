import React, { useEffect, useState } from 'react'
import MainCarousel from './MainCarousel'
import ProductBox from '../../component/ProductBox'
import { useParams } from 'react-router-dom';
import { productApi } from '../../Api/productApi';
import Loading from '../../component/Loading';

export default function Home() {
  var [products, setProducts] = useState({});
  var [loading, setLoading] = useState(true);
  var myView1 =
  loading === true? <Loading /> : <ProductBox products={products} />;
  var { pageNum} = useParams();
  var params ={
    populate: "*",
    pagination:{
      pageSize: 8,
      page: pageNum ? pageNum: 1,
  },
  sort: {
    id: "desc",
  },
};
  useEffect (() => {
  const fetchData = async () => {
  var response = await productApi.getAll(params);
  setProducts (response.data.data);
  setLoading (false);
  };
  fetchData();
},[]);
  return (
  <div>
  <MainCarousel />
  {myView1}
  </div>
  );
}
