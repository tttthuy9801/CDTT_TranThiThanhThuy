import React from 'react'

export default function Filter(props) {
  var handleFilterByName = props.handleFilterByName
  var handleFilterByMaxPrice = props.handleFilterByMaxPrice
  var handleFilterByMinPrice = props.handleFilterByMinPrice
  return (
    <div className='well well-small'>
      <input type='text' placeholder='Seach' onChange={handleFilterByName}/>&nbsp;&nbsp;
      <input type='text' placeholder='Max' onChange={handleFilterByMaxPrice}/>&nbsp;&nbsp;
      <input type='text' placeholder='Min' onChange={handleFilterByMinPrice}/>
    </div>
  )
}
