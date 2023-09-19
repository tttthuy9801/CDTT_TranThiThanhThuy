import React, { useEffect, useState } from 'react'
import { categoryApi } from '../Api/categoryApi'
import SelectBox from './SelectBox';
export default function CategorySelect(props) {
    const defaultValue=props.defaultValue
    var [categories, setCategories] = useState([])
    var [loading, setLoading] = useState(true);
    const handleChange=props.handleChange
    var myView = loading === true ? <select><option>Loading categories</option></select> : <SelectBox name='category'  data={categories} defaultValue={defaultValue} handleChange={handleChange} />

    useEffect(() => {
        const fetchData = async () => {
            var response = await categoryApi.getAll();
            var temp = response.data.data;
            setCategories(temp.map(category => {
                
                return {
                    value: category.id,
                    label: category.attributes.categoryName,
                    
                }
            }))
            setLoading(false)
            
        }
        fetchData()
    }, [])
    return (
        <div>{myView}</div>
    )
}
