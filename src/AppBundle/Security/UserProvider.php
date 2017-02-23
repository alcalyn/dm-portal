<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;

class UserProvider implements UserProviderInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@InheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $user = $this->userRepository->findOneByUsername($username);

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return $user;
    }

    /**
     * {@InheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof UserInterface) {
            throw new UnsupportedUserException(sprintf('Expected an instance of UserInterface, but got "%s".', get_class($user)));
        }

        if (null === $reloadedUser = $this->loadUserByUsername($user->getUsername())) {
            throw new UsernameNotFoundException(sprintf('User with username %s could not be reloaded.', $user->getUsername()));
        }

        return $reloadedUser;
    }

    /**
     * {@InheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === User::class;
    }
}
