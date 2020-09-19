<?php

interface IControllerHooks {
    function beforeActionHook();
    function afterActionHook(IResponse $response);
}