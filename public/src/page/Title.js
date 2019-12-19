import React from 'react'
import '../css/Title.css'
class Title extends React.Component{
  constructor(props){
    super(props)
  }
  render() {
    return (
      <h5 className='text-white text-center letter-spacing3  title'>{this.props.title}</h5>
    );
  }
}

export default Title;
