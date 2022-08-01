/*
  A17
*/
import { manageBehaviors } from '@area17/a17-behaviors'
import {
    focusDisplayHandler,
    ios100vhFix,
    resized,
    responsiveImageUpdate
} from '@area17/a17-helpers'
import lazyload from '@area17/a17-lazyload'

import * as Behaviors from './behaviors'

window.A17 = window.A17 || {}

document.addEventListener('DOMContentLoaded', function () {
    // adds a `--1vh` CSS variable to `:root`
    ios100vhFix()

    // make safari recalc image sizes
    responsiveImageUpdate()

    // watch what triggers a focus event
    focusDisplayHandler()

    // on resize, check
    resized()

    // lazyload images / videos / iframes
    lazyload()

    // register behaviors
    manageBehaviors.init(Behaviors)
})
