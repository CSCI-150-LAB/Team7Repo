<?php

interface IViewRenderer {
    function render(array $views);
    function getContents();
}