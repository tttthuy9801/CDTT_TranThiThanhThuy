import React, { useEffect, useState } from "react";
import { ToastContainer, toast } from "react-toastify";
import CategorySelect from "../../../component/CategorySelect";
import { productApi } from "../../../Api/productApi";
import { validateProduct } from "../../../helpers/validate";
import "react-toastify/dist/ReactToastify.css";
import FileUpLoad from "../../../component/FileUpLoad";
import AppUrl from "../../../Api/AppUrl";
import { useParams } from "react-router-dom";

export default function AdminProductEdit() {
  const { id } = useParams();
  const [data, setData] = useState({
    productName: "",
    description: "",
    category: "",
    price: "",
    detail: "",
    image: [],
  });
  const [images, setImages] = useState([]);
  useEffect(() => {
    const fetchData = async (id) => {
      var params = {
        populate: "*",
      };
      var response = await productApi.get(id, params);
      var oldProduct = response.data.data;
      setData({
        productName: oldProduct.attributes.productName,
        description: oldProduct.attributes.description,
        category: oldProduct.attributes.category.data.id,
        detail: oldProduct.attributes.detail,
        price: oldProduct.attributes.price,
        image: oldProduct.attributes.image.data.map((img) => img.id),
      });
      var oldImages = oldProduct.attributes.image.data.map((img) => {
        return {
          id: img.id,
          url: img.attributes.url,
        };
      });
      setImages([...oldImages]);
    };
    fetchData(id);
  }, [id]);
  const addImage = (id, url) => {
    setData({
      ...data,
      image: [...data.image, id],
    });
    setImages([
      ...images,
      {
        id: id,
        url: url,
      },
    ]);
  };
  const handleRemove = (e) => {
    var id = e.target.name;
    setData({
      ...data,
      image: data.image.filter((img) => {
        return img != id;
      }),
    });
    setImages(
      images.filter((img) => {
        return img.id != id;
      })
    );
  };
  var myViewImage =
    images.length == 0
      ? "No image"
      : images.map((img) => {
          return (
            <div>
              <img
                src={AppUrl.ImageUrl + img.url}
                alt="hinh"
                name={img.id}
                style={{ margin: "5px", width: "150px" }}
              />
              <button
                className="btn icon-trash bg-danger"
                name={img.id}
                onClick={handleRemove}></button>
            </div>
          );
        });
  const handleSubmit = (e) => {
    e.preventDefault();
    var err = validateProduct(data);
    if (err == "") {
      const updateProduct = async (id, data) => {
        var sendData = {
          data: data,
        };
        try {
          console.log(sendData);
          const response = await productApi.update(id, sendData);
          console.log(response);
          if (response.status == "200") toast.success("thanh cong");
          document.getElementById("editProduct").reset();
          setData({
            productName: "",
            description: "",
            category: "",
            price: "",
            detail: "",
            image: [],
          });
        } catch (error) {
          toast.error(" " + error);
        }
      };
      updateProduct(id, data);
    } else {
      toast.error(err);
      return false;
    }
  };
  const handleChange = (event) => {
    setData({
      ...data,
      [event.target.name]: event.target.value,
    });
    console.log("data", data);
  };

  return (
    <>
      <div className="row">
        <h2>Edit Product</h2>
        <br />
      </div>
      <div className="row">
        <div className="col-8">
          <form id="editProduct" onSubmit={handleSubmit}>
            <div className="form-group row">
              <label htmlFor="productName" className="col-2 col-form-label">
                Product Name
              </label>
              <div className="col-9">
                <input
                  id="productName"
                  name="productName"
                  placeholder="productName"
                  type="text"
                  className="form-control"
                  required="required"
                  onChange={handleChange}
                  value={data.productName}
                />
              </div>
            </div>
            <div className="form-group row">
              <label htmlFor="description" className="col-2 col-form-label">
                Description
              </label>
              <div className="col-9">
                <textarea
                  id="description"
                  name="description"
                  onChange={handleChange}
                  cols={40}
                  rows={2.5}
                  className="form-control"
                  defaultValue={""}
                  value={data.description}
                />
              </div>
            </div>
            <div className="form-group row">
              <label htmlFor="detail" className="col-2 col-form-label">
                Detail
              </label>
              <div className="col-9">
                <textarea
                  id="detail"
                  name="detail"
                  onChange={handleChange}
                  cols={40}
                  rows={2}
                  className="form-control"
                  defaultValue={""}
                  value={data.detail}></textarea>
              </div>
            </div>
            <div className="form-group row">
              <label htmlFor="price" className="col-2 col-form-label">
                Price
              </label>
              <div className="col-9">
                <input
                  id="price"
                  name="price"
                  type="number"
                  className="form-control"
                  onChange={handleChange}
                  value={data.price}
                />
              </div>
            </div>
            <div className="form-group row">
              <label htmlFor="select" className="col-2 col-form-label">
                Category
              </label>
              <div className="col-9">
                <CategorySelect
                  handleChange={handleChange}
                  defaultValue={data.category}
                />
              </div>
            </div>
            <div className="form-group row">
              <div className="offset-4 col-9">
                <button name="submit" type="submit" className="btn btn-success">
                  Submit
                </button>
              </div>
            </div>
          </form>
        </div>
        <div className="col-4">
          <FileUpLoad addImage={addImage} />
          <div id="uploadsImgs">{myViewImage}</div>
        </div>

        <ToastContainer
          position="top-right"
          autoClose={5000}
          hideProgressBar={false}
          newestOnTop={false}
          closeOnClick
          rtl={true}
          pauseOnFocusLoss
          draggable
          pauseOnHover
          theme="colored"
        />
      </div>
    </>
  );
}
