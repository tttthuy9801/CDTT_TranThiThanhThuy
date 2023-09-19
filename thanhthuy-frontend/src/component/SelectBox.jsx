import React from 'react'

export default function SelectBox(props) {
    const name = props.name
    const defaultValue = props.defaultValue
    const data = props.data
    const handleChange=props.handleChange

    var myView = data.map((dataItem) => {
        return <option value={dataItem.value}>{dataItem.label}</option>
        
    })
    return (
        <select name={name} defaultValue={defaultValue} onChange={handleChange}>
            {myView}
        </select>
    )
}
