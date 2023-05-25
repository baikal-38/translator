<?php
namespace JsonParser;

require_once "vendor/autoload.php";
require_once "z_JSONLexer.php";
require_once "z_JSONParser.php";

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\ParserRuleContext;
use Antlr\Antlr4\Runtime\Tree\ErrorNode;
use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
use Antlr\Antlr4\Runtime\Tree\ParseTreeWalker;
use Antlr\Antlr4\Runtime\Tree\TerminalNode;
use z_JSONLexer;
use z_JSONParser;

final class TreeShapeListener implements ParseTreeListener {
    public function visitTerminal(TerminalNode $node) : void {}
    public function visitErrorNode(ErrorNode $node) : void {}
    public function exitEveryRule(ParserRuleContext $ctx) : void {}

    public function enterEveryRule(ParserRuleContext $ctx) : void {
        echo $ctx->getText();
    }
}




$input = InputStream::fromPath($argv[1]);
$lexer = new z_JSONLexer($input);
$tokens = new CommonTokenStream($lexer);
$parser = new z_JSONParser($tokens);
$parser->addErrorListener(new DiagnosticErrorListener());
$parser->setBuildParseTree(true);
$tree = $parser->json();


ParseTreeWalker::default()->walk(new TreeShapeListener(), $tree);

