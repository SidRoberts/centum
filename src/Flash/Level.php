<?php

namespace Centum\Flash;

enum Level: string
{
    case SUCCESS = "success";
    case INFO    = "info";
    case WARNING = "warning";
    case DANGER  = "danger";
}
