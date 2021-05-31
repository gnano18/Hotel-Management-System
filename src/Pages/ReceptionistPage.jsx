import React from 'react'

import Dhoma from '../Components/Dhoma'
import rooms from '../Assets/rooms'

export default function ReceptionistPage() {
    return (
        <div className=" tw-grid tw-grid-cols-3 tw-ml-52 " >
            {
                rooms.map(room => (

                    <Dhoma key={room.ID} room={room} />

                ))
            }

        </div >

    )
}
