import React from 'react'
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';

export default function Dhoma(props) {
  return (
    <Card style={{ width: '10rem', display: 'box' }} >
      <Card.Img variant="top" src={props.room.image} />
      <Card.Body>
        <Card.Title>{props.room.name}</Card.Title>
        <Card.Text>
          price: {props.room.price}
        </Card.Text>
        <Button variant="primary">Prenoto</Button>
      </Card.Body>
    </Card>
  )
}
