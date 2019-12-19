import React from 'react'

class TextConsumer extends React.Component {


  render() {
    console.log(this.props)
    return (
      <div>
        {this.props.value.userinfo.id}
      </div>
    );
  }
}

export default TextConsumer;
