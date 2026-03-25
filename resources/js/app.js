import './lazyload.js';

import gsap from 'gsap';
import Draggable from 'gsap/Draggable';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(Draggable, ScrollTrigger);

window.gsap = gsap;
window.Draggable = Draggable;
window.ScrollTrigger = ScrollTrigger;

import './components/slider.js';