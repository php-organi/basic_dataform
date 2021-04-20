<?php

namespace Hanbit;

interface Routes{
  public function getRoutes(): array;
  public function getAuthentication(): \Hanbit\Authentication;
}