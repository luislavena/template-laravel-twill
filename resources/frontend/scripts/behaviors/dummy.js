import { createBehavior } from '@area17/a17-behaviors'

const dummy = createBehavior(
    'dummy',
    {
        hello() {
            console.log(
                "Hello, I'm just a dummy behavior. You should delete me :) "
            )
        }
    },
    {
        init() {
            this.hello()
        }
    }
)

export default dummy
