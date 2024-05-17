<?php

namespace App\Controller\Admin\Trait;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

trait EditOnlyTrait
{

  public function configureActions(Actions $actions): Actions
  {
    $actions->disable(Action::NEW, Action::DELETE, Action::SAVE_AND_CONTINUE);
    return $actions;
  }
}
