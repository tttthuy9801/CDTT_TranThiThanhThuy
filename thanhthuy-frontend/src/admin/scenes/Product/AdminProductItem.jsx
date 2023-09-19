import React from "react";
import AppUrl from "../../../Api/AppUrl";
import { Link } from "react-router-dom";

export default function AdminProductItem(props) {
  var stt = props.stt;
  var product = props.product;
  var handleDelete = props.handleDelete;
  var handlePublish = props.handlePublish;
  var myView =
    product.attributes.publishedAt == null ? (
      <input
        onClick={handlePublish}
        name={product.id}
        style={{ width: "60px" }}
        type="range"
        min="0"
        max="1"
        value="0"
      />
    ) : (
      <input
        onClick={handlePublish}
        name={product.id}
        style={{ width: "60px" }}
        type="range"
        min="0"
        max="1"
        value="1"
      />
    );
  return (
    <tr className="odd">
      <td className="sorting_1 dtr-control" tabIndex={0}>
        {stt}
      </td>
      <td>{product.id}</td>
      <td>{product.attributes.productName}</td>
      <td>
        <img
          style={{ width: "80px", height: "80px" }}
          src={
            AppUrl.ImageUrl + product.attributes.image.data[0].attributes.url
          }
          alt="hinhsanpham"
        />
      </td>
      <td>{product.attributes.price}</td>
      <td>{myView}</td>
      <td style={{ fontSize: "1.5em" }}>
        <Link to={"/admin/product/" + product.id}>
          <i className="icon-eye-open"></i>
        </Link>
        <Link to={"/admin/product/edit/" + product.id}>
          <i className="fas fa-edit"></i>
        </Link>
        <i name={product.id} className="icon-trash" onClick={handleDelete}></i>
      </td>
    </tr>
  );
}
