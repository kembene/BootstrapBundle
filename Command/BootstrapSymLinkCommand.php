<?php
namespace Kinwae\BootstrapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class BootstrapSymLinkCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('kinwae_bootstrap:link')
            ->setDescription('Creates a symbolic link to the installed twitter/bootstrap lib')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command creates a symlink to the twitter bootstrap in the webroot folder



your application's web root. Defaults to the configured bundle parameter "web"
<info>--webroot</info> option:

<info>php %command.full_name%  --webroot</info>

sub directory where the bootstrap symlink will be placed <info>--bootstrap_dir</info> option:

<info>php %command.full_name% web --bootstrap_dir </info>

symlink name <info>--bootstrap_name</info> option:

<info>php %command.full_name% web --bootstrap_name </info>

EOT
        )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $container = $this->getContainer();

        $root_dir = $container->getParameter("kernel.root_dir")."/..";
        $root_dir = realpath($root_dir);

        $web_dir = $container->getParameter("kinwae_bootstrap.webroot");
        $web_dir = $root_dir."/$web_dir";
        $twitter_dir = $container->getParameter("kinwae_bootstrap.bootstrap_install_dir");


        $web_dir = realpath(rtrim($web_dir, '/'));
        $twitter_install_dir = realpath($root_dir."/".trim($twitter_dir,"\\/"));

        if (!is_dir($web_dir)) {
            throw new \InvalidArgumentException(sprintf('The target directory "%s" does not exist.', $web_dir));
        }

        $output->writeln("Verifying twitter bootstrap installation");
        if (!is_dir($twitter_install_dir)) {
            throw new \InvalidArgumentException(sprintf('Twitter install directory "%s" does not exist.', $twitter_install_dir));
        }


        $dir = $container->getParameter("kinwae_bootstrap.bootstrap_dir");
        $dir = rtrim($dir, '/');
        $name = $container->getParameter("kinwae_bootstrap.bootstrap_name");

        $filesystem = $this->getFileSystem();

        $dest_dir = $web_dir."/$dir";
        $source_dir = $twitter_install_dir;
        $filesystem->mkdir($dest_dir);

        $dest_dir .= "/$name";

        $output->writeln("Creating symlink");
        $filesystem->symlink($source_dir,$dest_dir);

        $output->writeln("symlink created");
    }

    /**
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    function getFileSystem(){
        return $this->getContainer()->get("filesystem");
    }
}
