<?php

interface IRequest {
    function getControllerName();
    function getActionName();
    function getGetVar($name);
    function getPostVar($name);
    function getRequestVar($name);
    function getRouteParams();
}