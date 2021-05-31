import React from 'react'

export class Form extends React.Component {

  constructor(props) {
    super(props);

    this.state = { value: '' };
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChange = this.handleChange.bind(this);
  }

  handleSubmit(event) {
    alert('A name was submitted: ' + this.state.value);
    event.preventDefault();
  }

  handleChange(event) {

    this.setState({value: event.target.value})

  }

  render() {

    return (

      <form action="" onSubmit={this.handleSubmit} >

        <label>Name:
          <input type="text" value={this.state.value} onChange={this.handleChange} />
        </label>

        <input type="submit" value="Submit" />

      </form>

    );

  }
  
}
export default Form;





